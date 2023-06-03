<?php

namespace Database\Seeders;

use App\Models\Twitter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TwitterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Twitter::factory()->count(5000)->create();
    }
}
