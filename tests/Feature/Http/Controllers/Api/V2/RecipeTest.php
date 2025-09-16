<?php

use App\Models\{Category, Recipe, User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

pest()->use(RefreshDatabase::class);

test('recipes index', function () {
    Sanctum::actingAs(User::factory()->create());

    Category::factory(10)->create();

    Recipe::factory(15)->create();

    $response = $this->getJson('/api/v2/recipes');

    $response->assertJsonCount(15, 'data')
        ->assertJsonStructure([
            'data' => [],
            'links' => [],
            'meta' => []
        ]);
});
