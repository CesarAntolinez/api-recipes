<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\Tag\{TagStoreRequest, TagUpdateRequest};
use App\Http\Resources\Tag\{TagCollection, TagResource};
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return TagCollection
     */
    public function index()
    {
        return new TagCollection(Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagStoreRequest $request
     * @return TagResource
     */
    public function store(TagStoreRequest $request)
    {
        $tag = Tag::create($request->validated());

        return new TagResource($tag);
    }

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     * @return TagResource
     */
    public function show(Tag $tag)
    {
        $tag->load('recipes');

        return new TagResource($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TagUpdateRequest $request
     * @param Tag $tag
     * @return TagResource
     */
    public function update(TagUpdateRequest $request, Tag $tag)
    {
        $tag->update($request->validated());

        $tag->load('recipes');

        return new TagResource($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return response()->noContent();
    }
}
