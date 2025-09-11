<?php

use App\Models\{Category, Recipe, User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;

pest()->use(RefreshDatabase::class);

test('recipes index', function () {
    Sanctum::actingAs(User::factory()->create());

    Category::factory(10)->create();

    $recipes = Recipe::factory(15)->create();

    $response = $this->getJson('/api/recipes');

    // $response->assertStatus(200);
    $response->assertJsonCount(15, 'data')
        ->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'type',
                    'attributes' => ['title', 'description']
                ],
            ],
        ]);
});

test('recipes show', function () {
    Sanctum::actingAs(User::factory()->create());

    Category::factory(10)->create();

    $recipe = Recipe::factory()->create();

    $response = $this->get("/api/recipes/$recipe->id");

    $response->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            'data' => [
                'id',
                'type',
                'attributes' => ['title', 'description']
            ],
        ]);
});

test('recipes destroy', function () {

    Sanctum::actingAs(User::factory()->create());
    Category::factory(10)->create();

    $recipe = Recipe::factory()->create();
    $response = $this->deleteJson("/api/recipes/$recipe->id");

    $response->assertStatus(Response::HTTP_NO_CONTENT);
});
