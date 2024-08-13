<?php

namespace App\Http\Controllers;

use App\Models\YouTubeChannel;
use Illuminate\Http\Request;

class YouTubeChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $channels = YouTubeChannel::all();
        return response()->json($channels);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $channel = YouTubeChannel::create($request->all());
        return response()->json($channel, 201);
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
    public function update(Request $request, YouTubeChannel $youTubeChannel)
    {
        $youTubeChannel->update($request->all());
        return response()->json($youTubeChannel);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(YouTubeChannel $youTubeChannel)
    {
        $youTubeChannel->delete();
        return response()->json(['message' => 'Channel deleted']);
    }
}
