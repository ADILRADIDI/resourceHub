<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;




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
        // fetch->get() all podcasts where published is accepted from admin 
        $podcasts = Podcast::where('status', 'published')->get();
        return response()->json($podcasts);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if the user has the 'create podcasts' permission
        if (!$user->can('create podcasts')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Custom validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'logo' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            // 'audio_url' => 'nullable|file|mimes:mp3,wav|max:50000',
            'audio_url' => 'nullable|string|max:255',
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Log request data
        \Log::info('Request data: ', $request->all());

        // Log file upload status
        if ($request->hasFile('logo')) {
            \Log::info('Logo file received', [$request->file('logo')]);
        } else {
            \Log::info('No logo file received');
        }

        // Prepare data for creation
        $data = $request->only('title', 'description', 'audio_url');

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('uploads/logos', 'public');
        }

        // Create the podcast
        $podcast = Podcast::create($data);

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
        $podcasts = Podcast::where('title', 'like', '%' . $title . '%')->get();

        return response()->json($podcasts);
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
