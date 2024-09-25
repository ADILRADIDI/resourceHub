<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReactionController extends Controller
{
    /**
     * Display a listing of all reactions.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Check if the user has permission to view reactions
        if (!Auth::user()->can('manage reactions')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Retrieve all reactions
        $reactions = Reaction::all();
        return response()->json($reactions);
    }

    /**
     * Store a newly created reaction in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Check if the user has permission to create reactions
        if (!Auth::user()->can('manage reactions')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Validate incoming request data
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            // Accepts true or false
            'reaction_type' => 'required|boolean', 
        ]);

        // Create a new reaction
        
        $reaction = Reaction::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'reaction_type' => $request->reaction_type,
        ]);

        return response()->json($reaction, 201);
    }

    /**
     * Display the specified reaction.
     *
     * @param Reaction $reaction
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Reaction $reaction)
    {
        return response()->json($reaction);
    }

    /**
     * Remove the specified reaction from storage.
     *
     * @param Reaction $reaction
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Reaction $reaction)
    {
        // Check if the user has permission to delete reactions
        if (!Auth::user()->can('manage reactions')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Delete the reaction
        $reaction->delete();
        return response()->json(['message' => 'Reaction deleted']);
    }
}
