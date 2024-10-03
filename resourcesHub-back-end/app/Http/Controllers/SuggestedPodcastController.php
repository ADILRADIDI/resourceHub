<?php

namespace App\Http\Controllers;

use App\Models\SuggestedPodcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuggestedPodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Check if the user has the 'manage podcasts' permission
        if (!$user->can('manage podcasts')) {
            return response()->json(['error' => 'Unauthorized to view Suggested Podcasts'], 403);
        }

        $suggestedPodcasts = SuggestedPodcast::all();
        return response()->json($suggestedPodcasts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if the user has the 'suggest podcasts' permission
        if (!$user->can('suggest podcasts')) {
            return response()->json(['error' => 'Unauthorized to suggest Podcasts'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $suggestedPodcast = SuggestedPodcast::create([
            'title' => $request->title,
            'status' => 'pending', // default status for new suggestions
        ]);

        return response()->json($suggestedPodcast, 201);
    }

    /**
     * Accept a suggested podcast and create the actual podcast.
     */
    public function accept($id)
    {
        $user = Auth::user();

        // Check if the user has the 'manage podcasts' permission
        if (!$user->can('manage podcasts')) {
            return response()->json(['error' => 'Unauthorized to accept Suggested Podcasts'], 403);
        }

        $suggestedPodcast = SuggestedPodcast::find($id);

        if (!$suggestedPodcast) {
            return response()->json(['error' => 'Suggested Podcast not found'], 404);
        }

        // Create the actual podcast (assuming you have a Podcast model and migration)
        // You can replace this part with the actual logic to create a podcast
        // For demonstration, I'm just updating the status
        $suggestedPodcast->update(['status' => 'accepted']);

        return response()->json($suggestedPodcast);
    }

    /**
     * Reject a suggested podcast.
     */
    public function reject($id)
    {
        $user = Auth::user();

        // Check if the user has the 'manage podcasts' permission
        if (!$user->can('manage podcasts')) {
            return response()->json(['error' => 'Unauthorized to reject Suggested Podcasts'], 403);
        }

        $suggestedPodcast = SuggestedPodcast::find($id);

        if (!$suggestedPodcast) {
            return response()->json(['error' => 'Suggested Podcast not found'], 404);
        }

        $suggestedPodcast->update(['status' => 'rejected']);

        return response()->json($suggestedPodcast);
    }

    //
    public function destroy($id)
    {
        $user = Auth::user();

        // Check if the user has the 'manage podcasts' permission
        if (!$user->can('manage podcasts')) {
            return response()->json(['error' => 'Unauthorized to delete Suggested Podcasts'], 403);
        }

        $suggestedPodcast = SuggestedPodcast::find($id);
        if (!$suggestedPodcast) {
            return response()->json(['error' => 'Suggested Podcast not found'], 404);
        }
        $suggestedPodcast->delete();

        return response()->json(['message' => 'Suggested Podcast deleted successfully']);
    }
}
