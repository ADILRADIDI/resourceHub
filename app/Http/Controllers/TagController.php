<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // get  all tags from data base
    public function index()
    {
        $tags = Tag::all();
        return response()->json($tags);
    }

    /**
     * Store a newly created resource in storage.
     */
    // store new tag in database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tag = Tag::create($request->all());
        return response()->json($tag, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return response()->json($tag);
    }

    /**
     * Update the specified resource in storage.
     */
    // edit tag in my database
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
        ]);

        $tag->update($request->all());
        return response()->json($tag);
    }

    /**
     * Remove the specified resource from storage.
     */
        // Remove tag in my database
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->json(['message' => 'Tag deleted']);
    }
}
