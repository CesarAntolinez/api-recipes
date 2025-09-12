<?php

use App\Models\{Tag, User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;

pest()->use(RefreshDatabase::class);

test('tag index', function () {
    Sanctum::actingAs(User::factory()->create());

    Tag::factory(3)->create();

    $response = $this->getJson('/api/v1/tags');

    // $response->assertStatus(200);
    $response->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'type',
                    'attributes' => ['name'],
                    /*'relationships' => [
                        'recipes' => []
                    ]*/
                ],
            ],
        ]);
});

test('tag show', function () {
    Sanctum::actingAs(User::factory()->create());

    $tag = Tag::factory()->create();

    $response = $this->get("/api/v1/tags/$tag->id");

    $response->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            'data' => [
                'id',
                'type',
                'attributes' => ['name'],
                'relationships' => [
                    'recipes' => []
                ]
            ],
        ]);
});
