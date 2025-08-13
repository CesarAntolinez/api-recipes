<?php

use App\Models\{Category, User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Sanctum\Sanctum;

test('test index', function () {
    // create user and login
    Sanctum::actingAs(User::factory()->create());

    // create categories
    $categories = Category::factory()->count(5)->create();
    $response = $this->getJson('/api/categories');
    $response->assertJsonCount(2, 'data')
        ->assertJsonStructure([
            'data' => [
                'id',
                'type',
                'attributes' => ['name']
            ],
        ]);

    $response->assertStatus(200);
});

test('test show', function () {
    // create user and login
    Sanctum::actingAs(User::factory()->create());

    // create categories
    $category = Category::factory()->create();
    $response = $this->getJson('/api/categories/' . $category->id);
    $response->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            'data' => [
                'id',
                'type',
                'attributes' => ['name']
            ],
        ]);

    $response->assertStatus(200);
});
