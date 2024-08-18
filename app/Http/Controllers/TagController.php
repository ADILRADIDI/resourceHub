<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // get  all tags from data base
    public function index()
    {
        $user = Auth::user();

        // Check if the user has the 'manage tags' permission
        if (!$user->can('manage tags')) {
            return response()->json(['error' => 'Unauthorized to view Tags'], 403);
        }
        // get al tags
        $tags = Tag::all();
        return response()->json($tags);
    }

    /**
     * Store a newly created resource in storage.
     */
    // store new tag in database
    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if the user has the 'manage tags' permission
        if (!$user->can('manage tags')) {
            return response()->json(['error' => 'Unauthorized to Add Tags'], 403);
        }
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
        $user = Auth::user();

        // Check if the user has the 'manage tags' permission
        if (!$user->can('manage tags')) {
            return response()->json(['error' => 'Unauthorized to update Tags'], 403);
        }
        // validation
        $request->validate([
            'name' => 'nullable|string|max:255',
        ]);
        // update tags in db
        $tag->update($request->all());
        // return format json tags is updated
        return response()->json($tag);
    }

    /**
     * Remove the specified resource from storage.
     */
        // Remove tag in my database
    public function destroy(Tag $tag)
    {
        $user = Auth::user();

        // Check if the user has the 'manage tags' permission
        if (!$user->can('manage tags')) {
            return response()->json(['error' => 'Unauthorized to update Tags'], 403);
        }
        // delete tag in db
        $tag->delete();
        // return message is deleted
        return response()->json(['message' => 'Tag deleted succcessfully']);
    }
}
