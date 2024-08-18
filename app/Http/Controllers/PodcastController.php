<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PodcastController extends Controller
{
    // afficher listing all podcasts
    public function index()
    {
        $user = Auth::user();

        // Check if the user has the 'view podcasts' permission
        if (!$user->can('view podcasts')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        // fetch->get() all podcasts 
        $podcasts = Podcast::all();
        return response()->json($podcasts);
    }

    // store new podcast 
    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if the user has the 'create podcasts' permission
        if (!$user->can('create podcasts')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // // Check if the user is premium
        // if (!$user || !$user->premium) {
        //     return response()->json(['error' => 'Access restricted to premium users'], 403);
        // }

        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'logo' => 'nullable|string',
            'audio_url' => 'nullable|string',
        ]);

        // create a new podcast
        $podcast = Podcast::create($request->all());
        // return status 201 success add poscasts
        return response()->json($podcast, 201);
    }

    //function search a podcasts by title
    public function search(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Retrieve the search term from the request
        $title = $request->input('title');

        // Search for events by title
        $events = Event::where('title', 'like', '%' . $title . '%')->get();
        
        return response()->json($events);
    }

    

    // Display the specified podcast by {id}
    public function show($id)
    {
        // Fetch podcast by ID
        $podcast = Podcast::find($id);
        // Check if podcast exists or not 
        if (!$podcast) {
            return response()->json(['message' => 'Podcast not found'], 404);
        }
        return response()->json($podcast);
    }

    // Update the specified podcast in database
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        // Check if the user has the 'create podcasts' permission
        if (!$user->can('edit podcasts')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        // validate the request data
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'logo' => 'sometimes|string',
            'audio_url' => 'sometimes|string',
        ]);

        // Fetch podcast by /{id}
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
        $user = Auth::user();

        // Check if the user has the 'delete podcasts' permission
        if (!$user->can('delete podcasts')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        // Fetch podcast by /{id}
        $podcast = Podcast::find($id);
        // Check if podcast exists
        if (!$podcast) {
            return response()->json(['message' => 'Podcast not found'], 404);
        }
        // Delete the podcast
        $podcast->delete();
        // return message success delete podcast
        return response()->json(['message' => 'Podcast deleted']);
    }
}
/**--------------------------|
 * created by : Adil radidi  |
 * 16 august 2024            |
 * managment podcasts        |
 *---------------------------| 
 */