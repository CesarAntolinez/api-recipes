<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Recipe\RecipeCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'type' => 'category',
            'attributes' => [
                'name' => $this->name,
            ],
            'relationships' => [
                'recipes' => new RecipeCollection($this->recipes),
            ]
        ];
    }
}
