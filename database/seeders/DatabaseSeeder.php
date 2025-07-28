<?php

namespace Database\Seeders;

use App\Models\{Category, User, Tag, Recipe};
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $categories = Category::factory(10)->create();
        $tags = Tag::factory(20)->create();

        $recipes = Recipe::factory(50)
            ->create()->each(function ($recipe) use ($tags) {
                $recipe->tags()->attach($tags->random(rand(1, 5))->pluck('id'));
            });
    }
}
