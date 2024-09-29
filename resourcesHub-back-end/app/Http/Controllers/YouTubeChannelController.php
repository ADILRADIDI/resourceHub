<?php

namespace App\Http\Controllers;

use App\Models\YouTubeChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class YouTubeChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAllYt(){
        $user = Auth::user();
        // Check if the user has the 'view YouTubeChannel' permission
        if (!$user->can('view yt channels')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $ytChannels = YouTubeChannel::all();
        return response()->json($ytChannels);
    }
    public function index()
    {
        $user = Auth::user();
        // Check if the user has the 'view YouTubeChannel' permission
        if (!$user->can('view yt channels')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        // fetch->get() all YouTubeChannel where status = published
        $ytChannels = YouTubeChannel::where('status', 'published')->get();
        return response()->json($ytChannels);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        // Check if the user has the 'create YouTubeChannel' permission
        if (!$user->can('create yt channels')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        // validate the request
        $request->validate([
            'channel_name' => 'required',
            'channel_url' => 'required',
            ]);
        // create yt-chennels
        $channel = YouTubeChannel::create($request->all());
        // return channel json and status 201 is created
        return response()->json($channel, 201);
    }

    public function publishChannel($id)
{
    $user = Auth::user();

    // Check if the user has the 'super-admin' role
    if (!$user->hasRole('super-admin')) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    // Find the YouTube channel by its ID
    $channel = YouTubeChannel::find($id);

    // Check if the channel exists
    if (!$channel) {
        return response()->json(['error' => 'Channel not found'], 404);
    }

    // Update the status to 'published'
    $channel->status = 'published';
    $channel->save();

    return response()->json(['message' => 'Channel published successfully', 'channel' => $channel], 200);
}



    /**
     * Display the specified resource.
     */
    public function show(YouTubeChannel $youTubeChannel)
    {
        return response()->json($youTubeChannel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $user = Auth::user();
        // Check if the user has the 'update YouTubeChannel' permission
        if (!$user->can('edit yt channels')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        //validate request data
        $request->validate([
            'channel_name' => 'required|string|max:255',
            'channel_url' => 'required|string',
        ]);
        // Find yt-channel by {id}
        $youTubeChannel = YouTubeChannel::find($id);

        // check $channel is empty => channel not found..
        if (!$youTubeChannel) {
            return response()->json(['message' => 'channel not found'], 404);
        }
        // update this yt-channel
        $youTubeChannel->update($request->all());
        return response()->json($youTubeChannel);
    }

    public function search(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Retrieve the search term from the request
        $name = $request->input('name');
        // Search for channels by name
        // ->get() for get all okay
        $channels = YouTubeChannel::where('channel_name', 'like', '%' . $name . '%')->get();
        return response()->json($channels);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        // Check if the user has the 'delete YouTubeChannel' permission
        if (!$user->can('delete yt channels')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $youTubeChannel = YouTubeChannel::find($id);

        if (!$youTubeChannel) {
            return response()->json(['message' => 'youTubeChannel not found'], 404);
        }
        $youTubeChannel->delete();
        return response()->json(['message' => 'Channel deleted']);
    }
}
/**--------------------------|
 * created by : Adil radidi  |
 * 16 august 2024            |
 * managment YT-CHANNELS     |
 *---------------------------|
 */
