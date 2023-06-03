<?php

namespace Database\Factories;

use App\Enums\ProducerType;
use App\Models\Producer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends Factory<Producer>
 */
class ProducerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => Arr::random(ProducerType::cases()),
            'name' => fake()->name(),
            'avatar_link' => fake()->imageUrl(),
            'username' => fake()->userName(),
        ];
    }
}
