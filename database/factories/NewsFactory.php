<?php

namespace Database\Factories;

use App\Enums\ProducerType;
use App\Models\News;
use App\Models\Producer;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {
        $producer = Producer::factory()->create([
            "type" => ProducerType::News
        ]);
        return [
            'producer_id' => $producer->id,
            'title' => fake()->text(12),
            'content' => fake()->text(random_int(500, 5000)),
            'main_link' => fake()->url(),
            'source_link' => fake()->url(),
            'publication_date' => fake()->dateTime(),
        ];
    }
}
