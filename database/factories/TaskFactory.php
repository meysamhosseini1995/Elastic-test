<?php

namespace Database\Factories;

use App\Enums\IndexModels;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        return [
            "user_id" => $user->getAttribute('id'),
            'index_name' => Arr::random(IndexModels::cases()),
            "keyword" => implode(" + ", fake()->words(4)),
        ];
    }
}
