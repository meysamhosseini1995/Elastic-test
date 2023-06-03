<?php

namespace Database\Factories;

use App\Enums\ProducerType;
use App\Models\Producer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Instagram>
 */
class InstagramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $producer = Producer::factory()->create([
            "type" => ProducerType::Instagram
        ]);
        return [
            'producer_id' => $producer->id,
            'title' => fake()->text(12),
            'content' => fake()->text(random_int(500, 1000)),
            'source_link' => fake()->url(),
            'publication_date' => fake()->dateTime(),
        ];
    }
}
