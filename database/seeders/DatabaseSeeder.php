<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\TechNewsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TechNewsSeeder::class,
        ]);
    }
}
