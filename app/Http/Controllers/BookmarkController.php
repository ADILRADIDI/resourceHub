<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookmarks = Bookmark::all();
        return response()->json($bookmarks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $bookmark = Bookmark::create($request->all());
        return response()->json($bookmark, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bookmark = Bookmark::find($id);

        if (!$bookmark) {
            return response()->json(['message' => 'Bookmark not found'], 404);
        }

        return response()->json($bookmark);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'post_id' => 'nullable|exists:posts,id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $bookmark = Bookmark::find($id);

        if (!$bookmark) {
            return response()->json(['message' => 'Bookmark not found'], 404);
        }

        $bookmark->update($request->all());
        return response()->json($bookmark);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bookmark = Bookmark::find($id);

        if (!$bookmark) {
            return response()->json(['message' => 'Bookmark not found'], 404);
        }

        $bookmark->delete();
        return response()->json(['message' => 'Bookmark deleted']);
    }
}
