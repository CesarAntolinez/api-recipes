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
            'id' => $this->id,
            'type' => 'recipes',
            'attributes' => [
                'title' => $this->title,
                'description' => $this->description,
                'ingredients' => $this->ingredients,
                'preparation' => $this->preparation,
                'image' => $this->image,
                'published_at' => $this->published_at?->format('Y-m-d') ?? null,
                'slug' => $this->slug,
                'author' => $this->user->name,
                'category' => $this->category->name,
                'tags' => $this->tags->implode('name', ', '),
            ]
        ];
    }
}
