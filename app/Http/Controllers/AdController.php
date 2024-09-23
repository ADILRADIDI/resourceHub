<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure user is authenticated
    }

    // Display a listing of the ads
    public function index()
    {
        $user = Auth::user();

        // Check if the user has the 'view ads' permission
        // if (!$user->can('view Ad')) {
        //     return response()->json(['error' => 'Unauthorized'], 403);
        // }

        $ads = Ad::all();
        return response()->json($ads);
    }

    // Show the form for creating a new ad
    public function create()
    {
        // Return view for creating ad if using Blade
    }

    // Store a newly created ad in storage
    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if the user has the 'create ads' permission
        if (!$user->can('manage ads')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'image_url' => 'required|url',
        ]);

        $ad = Ad::create($request->all());
        return response()->json($ad, 201);
    }

    // Display the specified ad
    public function show($id)
    {
        $ad = Ad::findOrFail($id);
        return response()->json($ad);
    }

    // Show the form for editing the specified ad
    public function edit($id)
    {
        // Return view for editing ad if using Blade
    }

    // Update the specified ad in storage
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        // Check if the user has the 'edit ads' permission
        if (!$user->can('manage ads')) {
            return response()->json(['error' => 'Unauthorized to edit ad'], 403);
        }

        $ad = Ad::findOrFail($id);

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'url' => 'sometimes|required|url',
            'image_url' => 'sometimes|required|url',
        ]);

        $ad->update($request->all());
        return response()->json($ad);
    }

    // Remove the specified ad from storage
    public function destroy($id)
    {
        $user = Auth::user();

        // Check if the user has the 'delete ads' permission
        if (!$user->can('manage ads')) {
            return response()->json(['error' => 'Unauthorized to delete ad'], 403);
        }

        $ad = Ad::findOrFail($id);
        $ad->delete();
        return response()->json(['message' => 'Ad deleted']);
    }
}
