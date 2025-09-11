<?php

namespace App\Http\Controllers;

use App\Http\Requests\Recipe\{RecipeStoreRequest, RecipeUpdateRequest};
use App\Http\Resources\Recipe\{RecipeCollection, RecipeResource};
use App\Models\Recipe;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Response;

class RecipeController extends Controller
{
    use AuthorizesRequests;
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
        $recipe = $request->user()->recipes()->create($request->validated());

        if ($request->exists('tags'))
            $recipe->tags()->attach($request->tags);

        if ($request->hasFile('image')) {
            $name = str()->slug($recipe->title) . '-' . time() . '.' . $request->file('image')->extension();
            $recipe->image = $request->file('image')->storeAs('recipes', $name, 'public');

            $recipe->save();
        }

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
        $this->authorize('update', $recipe);

        $recipe->update($request->validated());

        if ($request->exists('tags'))
            $recipe->tags()->sync($request->tags);

        if ($request->hasFile('image')) {
            if (\Strage::disk('public')->exists($recipe->image))
                \Strage::disk('public')->delete($recipe->image);

            $name = str()->slug($recipe->title) . '-' . time() . '.' . $request->file('image')->extension();
            $recipe->image = $request->file('image')->storeAs('recipes', $name, 'public');

            $recipe->save();
        }

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
        $this->authorize('delete', $recipe);

        if (\Strage::disk('public')->exists($recipe->image))
            \Strage::disk('public')->delete($recipe->image);

        $recipe->delete();

        return response()->noContent();
    }
}
