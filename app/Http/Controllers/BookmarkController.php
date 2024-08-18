<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        // Check if the user has the 'view bookmarks' permission
        if (!$user->can('view bookmarks')) {
            return response()->json(['error' => 'Unauthorized to view bookmarks'], 403);
        }
        // get the ID of the authenticated user
        $userId = Auth::id();
        // get all bookmarks where the user_id matches the authenticated user's ID
        $bookmarks = Bookmark::where('user_id', $userId)->get();
        // Return the bookmarks a JSON
        return response()->json($bookmarks);
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if the user has the 'create bookmarks' permission
        if (!$user->can('create bookmarks')) {
            return response()->json(['error' => 'Unauthorized to create bookmarks'], 403);
        }
        // Validate the request data, ensuring 'post_id' exists in the 'posts' table
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);
        // Create a new bookmark with the provided data
        $bookmark = Bookmark::create([
            'user_id' => Auth::id(),  // Automatically set the authenticated user's ID
            'post_id' => $request->post_id,
        ]);
        // Return the created bookmark in JSON format with a 201 status (created)
        return response()->json($bookmark, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Find the bookmark by its ID
        $bookmark = Bookmark::find($id);
        // If the bookmark doesn't exist, return a 404 not found response
        if (!$bookmark) {
            return response()->json(['message' => 'Bookmark not found'], 404);
        }
        // Return the bookmark in JSON format
        return response()->json($bookmark);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        // Check if the user has the 'delete bookmarks' permission
        if (!$user->can('delete bookmarks')) {
            return response()->json(['error' => 'Unauthorized to delete bookmarks'], 403);
        }
        // Find the bookmark by its ID
        $bookmark = Bookmark::find($id);
        // If the bookmark doesn't exist, return a 404 not found response
        if (!$bookmark) {
            return response()->json(['message' => 'Bookmark not found'], 404);
        }
        // Delete the bookmark in DB
        $bookmark->delete();
        // Return a success message in JSON
        return response()->json(['message' => 'Bookmark deleted successfullly'], 200);
    }
}
// /**
//  *  * Created by: Adil Radidi      |
//  *      16 August 2024             |
//  *      Bookmark Management        |
//  */
