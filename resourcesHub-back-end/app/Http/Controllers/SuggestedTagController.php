<?php

namespace App\Http\Controllers;

use App\Models\SuggestedTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuggestedTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user->can('manage suggested tags')) {
            return response()->json(['error' => 'Unauthorized to view Suggested Tags'], 403);
        }

        $suggestedTags = Tag::all(); // Assuming you're working with the `Tag` model
        return response()->json($suggestedTags);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user->can('manage suggested tags')) {
            return response()->json(['error' => 'Unauthorized to Add Suggested Tags'], 403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable|in:draft,published,archived',
        ]);

        // Using the `Tag` model to create the tag with 'draft' status by default
        $suggestedTag = Tag::create([
            'name' => $request->input('name'),
            'status' => $request->input('status', 'draft'), // Default status is 'draft'
        ]);

        return response()->json($suggestedTag, 201);
    }

    /**
     * Get all tags with 'draft' status.
     */
    public function getDraftTags()
    {
        $user = Auth::user();

        if (!$user->can('manage suggested tags')) {
            return response()->json(['error' => 'Unauthorized to view draft Suggested Tags'], 403);
        }

        // Fetch all tags with 'draft' status
        $draftTags = Tag::where('status', 'draft')->get();
        return response()->json($draftTags);
    }

    /**
     * Accept a tag by changing its status to 'published'.
     */
    public function acceptTag($id)
    {
        $user = Auth::user();

        if (!$user->can('manage suggested tags')) {
            return response()->json(['error' => 'Unauthorized to accept Suggested Tags'], 403);
        }

        // Find the tag by ID in the `Tag` model
        $suggestedTag = Tag::find($id);

        if (!$suggestedTag) {
            return response()->json(['error' => 'Tag not found'], 404);
        }

        // Update the status to 'published'
        $suggestedTag->status = 'published';
        $suggestedTag->save();

        return response()->json(['message' => 'Tag accepted and status updated to published', 'tag' => $suggestedTag]);
    }

    /**
     * Display the specified resource.
     */
    public function show(SuggestedTag $suggestedTag)
    {
        return response()->json($suggestedTag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuggestedTag $suggestedTag)
    {
        $user = Auth::user();

        if (!$user->can('manage suggested tags')) {
            return response()->json(['error' => 'Unauthorized to update Suggested Tags'], 403);
        }

        $request->validate([
            'name' => 'nullable|string|max:255',
            'status' => 'nullable|in:draft,published,archived',
        ]);

        $suggestedTag->update($request->only(['name', 'status']));

        return response()->json($suggestedTag);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuggestedTag $suggestedTag)
    {
        $user = Auth::user();

        if (!$user->can('manage suggested tags')) {
            return response()->json(['error' => 'Unauthorized to delete Suggested Tags'], 403);
        }

        // Delete the specific suggested tag
        $suggestedTag->delete();

        return response()->json(['message' => 'Suggested Tag deleted successfully']);
    }
}
