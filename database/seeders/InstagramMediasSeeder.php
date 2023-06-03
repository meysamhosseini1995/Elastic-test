<?php

namespace Database\Seeders;

use App\Models\InstagramMedias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstagramMediasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InstagramMedias::factory()->count(500)->create();
    }
}
