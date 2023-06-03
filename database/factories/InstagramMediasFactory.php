<?php

namespace Database\Factories;

use App\Enums\InstagramMediaType;
use App\Models\Instagram;
use App\Models\InstagramMedias;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends Factory<InstagramMedias>
 */
class InstagramMediasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $instagram = Instagram::factory()->create();
        return [
            'instagram_id' => $instagram->id,
            'type' => Arr::random(InstagramMediaType::cases()),
            'media_link' => fake()->url(),
        ];
    }
}
