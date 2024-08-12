<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use Illuminate\Http\Request;

class PodcastController extends Controller
{
    // afficher listing all podcasts
    public function index()
    {
        // fetch->get() all podcasts
        $podcasts = Podcast::all();
        return response()->json($podcasts);
    }

    // store new podcast 
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'logo' => 'nullable|string',
            'audio_url' => 'nullable|string',
        ]);

        // Create a new podcast
        $podcast = Podcast::create($request->all());

        return response()->json($podcast, 201);
    }

    // Display the specified podcast
    public function show($id)
    {
        // Fetch podcast by ID
        $podcast = Podcast::find($id);

        // Check if podcast exists
        if (!$podcast) {
            return response()->json(['message' => 'Podcast not found'], 404);
        }

        return response()->json($podcast);
    }

    // Update the specified podcast in storage
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'logo' => 'sometimes|string',
            'audio_url' => 'sometimes|string',
        ]);

        // Fetch podcast by ID
        $podcast = Podcast::find($id);

        // Check if podcast exists
        if (!$podcast) {
            return response()->json(['message' => 'Podcast not found'], 404);
        }

        // Update the podcast
        $podcast->update($request->all());

        return response()->json($podcast);
    }

    // Remove the specified podcast from storage
    public function destroy($id)
    {
        // Fetch podcast by ID
        $podcast = Podcast::find($id);

        // Check if podcast exists
        if (!$podcast) {
            return response()->json(['message' => 'Podcast not found'], 404);
        }

        // Delete the podcast
        $podcast->delete();

        return response()->json(['message' => 'Podcast deleted']);
    }
}
