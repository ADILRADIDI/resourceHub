<?php

namespace App\Http\Controllers;

use App\Models\SuggestedTag;
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

        $suggestedTags = SuggestedTag::all();
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

        $suggestedTag = SuggestedTag::create([
            'name' => $request->input('name'),
            'status' => $request->input('status', 'draft'), // Default status is 'draft'
        ]);

        return response()->json($suggestedTag, 201);
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

        $suggestedTag->delete();
        return response()->json(['message' => 'Suggested Tag deleted successfully']);
    }
}
