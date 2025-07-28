<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title(),
            'description' => $this->faker->realText(),
            'ingredients' => $this->faker->realText(),
            'preparation' => $this->faker->realText(),
            // 'image' => $this->faker,
            // 'published_at' => $this->faker->dateTime(),
            // 'user_id' => $this->faker,
            // 'category_id' => $this->faker
        ];
    }
}
