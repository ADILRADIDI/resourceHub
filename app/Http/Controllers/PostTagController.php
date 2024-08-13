<?php

namespace App\Http\Controllers;

use App\Models\PostTag;
use Illuminate\Http\Request;

class PostTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postTags = PostTag::all();
        return response()->json($postTags);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'tag_id' => 'required|exists:tags,id',
        ]);

        $postTag = PostTag::create($request->all());
        return response()->json($postTag, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $postTag = PostTag::find($id);

        if (!$postTag) {
            return response()->json(['message' => 'PostTag not found'], 404);
        }

        return response()->json($postTag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'post_id' => 'nullable|exists:posts,id',
            'tag_id' => 'nullable|exists:tags,id',
        ]);

        $postTag = PostTag::find($id);

        if (!$postTag) {
            return response()->json(['message' => 'PostTag not found'], 404);
        }

        $postTag->update($request->all());
        return response()->json($postTag);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $postTag = PostTag::find($id);

        if (!$postTag) {
            return response()->json(['message' => 'PostTag not found'], 404);
        }

        $postTag->delete();
        return response()->json(['message' => 'PostTag deleted']);
    }
}
