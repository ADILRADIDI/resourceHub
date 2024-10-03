<?php

namespace App\Http\Controllers;

use App\Models\SuggestedYtChannel;
use App\Models\YouTubeChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuggestedYtChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $channels = SuggestedYtChannel::all();
        return response()->json($channels);
    }

    public function getDraftChannels()
    {
        $draftChannels = YouTubeChannel::where('status', 'draft')->get();
        return response()->json($draftChannels);
    }


    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'channel_name' => 'required|string|max:255',
    //         'channel_url' => 'required|url|max:255',
    //         'status' => 'nullable|in:draft,published,archived',
    //     ]);

    //     $channel = SuggestedYtChannel::create($request->all());
    //     return response()->json($channel, 201);
    // }

    public function store(Request $request)
    {
        $request->validate([
            'channel_name' => 'required|string|max:255',
            'channel_url' => 'required|url|max:255',
        ]);

        // Create the channel and set the status to 'draft'
        $channel = YouTubeChannel::create([
            'channel_name' => $request->channel_name,
            'channel_url' => $request->channel_url,
            'status' => 'draft',
        ]);

        return response()->json($channel, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SuggestedYtChannel $suggestedYtChannel)
    {
        return response()->json($suggestedYtChannel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuggestedYtChannel $suggestedYtChannel)
    {
        $request->validate([
            'channel_name' => 'nullable|string|max:255',
            'channel_url' => 'nullable|url|max:255',
            'status' => 'nullable|in:draft,published,archived',
        ]);

        $suggestedYtChannel->update($request->all());
        return response()->json($suggestedYtChannel);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuggestedYtChannel $suggestedYtChannel)
    {
        $suggestedYtChannel->delete();
        return response()->json(['message' => 'Suggested channel deleted successfully']);
    }

    /**
     * Accept a suggested channel and create a new channel.
     */
    // public function acceptSuggestedChannel($id)
    // {
    //     $user = Auth::user();

    //     // Check if the user has the 'manage channels' permission
    //     if (!$user->can('create yt channels')) {
    //         return response()->json(['error' => 'Unauthorized to accept Suggested Channels'], 403);
    //     }

    //     $suggestedChannel = SuggestedYtChannel::find($id);

    //     if (!$suggestedChannel) {
    //         return response()->json(['error' => 'Suggested Channel not found'], 404);
    //     }

    //     $channel = SuggestedYtChannel::create([
    //         'channel_name' => $suggestedChannel->channel_name,
    //         'channel_url' => $suggestedChannel->channel_url,
    //         'status' => 'published', // Set the status to 'published'
    //     ]);

    //     // Optionally, delete the suggested channel after creating the new channel
    //     $suggestedChannel->delete();

    //     return response()->json($channel, 201);
    // }

    // public function acceptSuggestedChannel($id)
    // {
    //     $user = Auth::user();

    //     // Check if the user has the 'manage channels' permission
    //     // if (!$user->can('create yt channels')) {
    //     //     return response()->json(['error' => 'Unauthorized to accept Suggested Channels'], 403);
    //     // }

    //     // Find the suggested channel
    //     $suggestedChannel = YouTubeChannel::find($id);

    //     if (!$suggestedChannel) {
    //         return response()->json(['error' => 'Suggested Channel not found'], 404);
    //     }

    //     // Update the status to 'published'
    //     $suggestedChannel->update([
    //         'status' => 'published',
    //     ]);

    //     return response()->json(['message' => 'Channel status updated to published'], 200);
    // }
}
