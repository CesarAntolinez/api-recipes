<?php

namespace App\Http\Controllers;

use App\Http\Requests\Recipe\{RecipeStoreRequest, RecipeUpdateRequest};
use App\Http\Resources\Recipe\{RecipeCollection, RecipeResource};
use App\Models\Recipe;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::query()->with(['category', 'tags', 'user'])->get();

        return new RecipeCollection($recipes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecipeStoreRequest $request)
    {
        $recipe = Recipe::create($request->validated());

        if ($request->exists('tags'))
            $recipe->tags()->attach($request->tags);

        return new RecipeResource($recipe);
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        $recipe->load(['category', 'tags', 'user']);

        return new RecipeResource($recipe);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RecipeUpdateRequest $request, Recipe $recipe)
    {
        $recipe->update($request->validated());

        if ($request->exists('tags'))
            $recipe->tags()->sync($request->tags);

        return new RecipeResource($recipe);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        return $recipe->delete();
    }
}
