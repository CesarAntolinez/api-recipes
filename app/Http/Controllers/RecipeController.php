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
        return RecipeCollection::collection(Recipe::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecipeStoreRequest $request)
    {
        $recipe = Recipe::create($request->validated());

        return new RecipeResource($recipe);
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        return new RecipeResource($recipe);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RecipeUpdateRequest $request, Recipe $recipe)
    {
        $recipe->update($request->validated());

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
