<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Idea>
 */
class IdeaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomElement(User::all())['id'] ?? User::factory(),
            'category_id' => $this->faker->randomElement(Category::all())['id'] ?? Category::factory(),
            'status_id' => $this->faker->randomElement(Status::all())['id'] ?? Status::factory(),
            'title' => ucwords( $this->faker->words(4, true) ),
            'description' => $this->faker->paragraph(5)
        ];
    }
}
