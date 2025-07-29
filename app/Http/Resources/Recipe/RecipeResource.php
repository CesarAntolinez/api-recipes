<?php

namespace App\Http\Resources\Recipe;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $request->id,
            'type' => 'recipes',
            'attributes' => [
                'title' => $request->title,
                'description' => $request->description,
                'ingredients' => $request->ingredients,
                'preparation' => $request->preparation,
                'image' => $request->image,
                'published_at' => $request->published_at?->format('Y-m-d') ?? null,
                'slug' => $request->slug,
                'author' => $request->user,
                'category' => $request->category,
                'tags' => $request->tags,
            ]
        ];
    }
}
