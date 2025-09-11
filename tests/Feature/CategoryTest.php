<?php

use App\Models\{Category, User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;

pest()->use(RefreshDatabase::class);

test('category index', function () {
    Sanctum::actingAs(User::factory()->create());

    Category::factory(3)->create();

    $response = $this->getJson('/api/categories');

    // $response->assertStatus(200);
    $response->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                ['id', 'type', 'attributes' => ['name']],
            ],
        ]);
});

test('category show', function () {
    Sanctum::actingAs(User::factory()->create());

    $category = Category::factory()->create();

    $response = $this->get("/api/categories/$category->id");

    $response->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            'data' => [
                'id',
                'type',
                'attributes' => ['name'],
            ],
        ]);
});
