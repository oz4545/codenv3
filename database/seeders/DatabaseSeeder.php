<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            DifficultySeeder::class,
            LevelSeeder::class,
            FormSeeder::class,
            QuestionSeeder::class,
            AnswerSeeder::class,
            UserAnswerSeeder::class,
            // Otros seeders
        ]);
    }
}
