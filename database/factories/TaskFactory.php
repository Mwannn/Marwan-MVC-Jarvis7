<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
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
        $faker = Faker::create();
        return [
            "name" => $faker->name(),
            "deadline" => now(),
            "status" => 'Belum selesai', // Fix: Remove fake()-> and use a string literal
            "description" => $faker->paragraph()
        ];
    }
}