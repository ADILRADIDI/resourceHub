<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\SuggestedTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function getAllTags(){
        $tags = Tag::all();
        return response()->json($tags);
     }


     public function publish($id)
     {
         $user = Auth::user();

         // Check if the user has the 'manage tags' permission
         if (!$user->can('manage tags')) {
             return response()->json(['error' => 'Unauthorized to publish tags'], 403);
         }

         // Find the tag by ID
         $tag = Tag::find($id);

         if (!$tag) {
             return response()->json(['error' => 'Tag not found'], 404);
         }

         // Update the status to 'published'
         $tag->status = 'published';
         $tag->save();

         return response()->json(['message' => 'Tag published successfully', 'tag' => $tag], 200);
     }

    // get  all tags from data base
    public function index()
    {
        $user = Auth::user();

        // Check if the user has the 'manage tags' permission
        if (!$user->can('manage tags')) {
            return response()->json(['error' => 'Unauthorized to view Tags'], 403);
        }
        // get al tags where status  published
        // $tags = Tag::all();
        $tags = Tag::where('status', 'published')->get();
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

    // in accpeted suggested tags from admin => creation tags
    public function acceptSuggestedTag($suggestedTagId)
    {
        $user = Auth::user();

        // Check if the user has the 'manage tags' permission
        if (!$user->can('manage tags')) {
            return response()->json(['error' => 'Unauthorized to accept Suggested Tags'], 403);
        }

        // Find the suggested tag
        $suggestedTag = SuggestedTag::find($suggestedTagId);

        if (!$suggestedTag) {
            return response()->json(['error' => 'Suggested Tag not found'], 404);
        }

        // Create a new tag from the suggested tag
        $tag = Tag::create([
            'name' => $suggestedTag->name,
            'status' => 'published',
        ]);

        // Optionally, delete the suggested tag after creating the new tag
        $suggestedTag->delete();

        return response()->json($tag, 201);
    }

    public function getByName($name)
    {
        $tag = Tag::where('name', $name)->first();

        if (!$tag) {
            return response()->json(['error' => 'Tag not found.'], 404);
        }

        return response()->json(['id' => $tag->id]);
    }

    public function getPopularTags()
    {
        try {
            $popularTags = Tag::limit(5)->get();


            if ($popularTags->isEmpty()) {
                return response()->json(['message' => 'No popular tags found.'], 404);
            }

            return response()->json($popularTags);
        } catch (\Exception $e) {
            \Log::error('Error fetching popular tags: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }



}
