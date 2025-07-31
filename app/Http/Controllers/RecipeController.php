<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\Recipe\{RecipeStoreRequest, RecipeUpdateRequest};
use App\Http\Resources\Recipe\{RecipeCollection, RecipeResource};
use App\Models\Recipe;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return RecipeCollection
     */
    public function index()
    {
        $recipes = Recipe::query()->with(['category', 'tags', 'user'])->get();

        return new RecipeCollection($recipes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RecipeStoreRequest $request
     * @return RecipeResource
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
     *
     * @param Recipe $recipe
     * @return RecipeResource
     */
    public function show(Recipe $recipe)
    {
        $recipe->load(['category', 'tags', 'user']);

        return new RecipeResource($recipe);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RecipeUpdateRequest $request
     * @param Recipe $recipe
     * @return RecipeResource
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
     *
     * @param Recipe $recipe
     * @return Response
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return response()->noContent();
    }
}
