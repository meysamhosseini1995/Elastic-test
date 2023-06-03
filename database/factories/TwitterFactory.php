<?php

namespace Database\Factories;

use App\Enums\ProducerType;
use App\Models\Producer;
use App\Models\Twitter;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Twitter>
 */
class TwitterFactory extends Factory
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
            "type" => ProducerType::Twitter
        ]);
        return [
            'producer_id' => $producer->id,
            'retweet' => random_int(10, 2000),
            'content' => fake()->text(random_int(50, 280)),
            'image_link' => fake()->imageUrl(),
            'source_link' => fake()->url(),
            'publication_date' => fake()->dateTime(),
        ];
    }
}
