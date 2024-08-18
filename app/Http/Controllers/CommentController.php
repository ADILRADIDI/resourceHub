<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $user = Auth::user();

        // Check if the user has the 'view comments' permission
        if (!$user->can('view comments')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $comments = Comment::all();
        return response()->json($comments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if the user has the 'create comments' permission
        if (!$user->can('create comments')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'body' => 'required|string',
        ]);
        // createe new comment in db
        $comment = Comment::create($request->all());
        // return status 201 created and commetn form json 
        return response()->json($comment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return response()->json($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $user = Auth::user();

        // check this user is premium mombre or not 
        if (!$user || !$user->is_premium) {
            return response()->json(['error' => 'Access restricted to premium users',
        'message' =>'You need to be a premium user to edit comments.'], 403);
        }

        // Check if the user has the 'edit comments' permission
        if (!$user->can('edit comments')) {
            return response()->json(['error' => 'Unauthorized to edit comment'], 403);
        }
        
        $request->validate([
            'body' => 'nullable|string',
        ]);

        $comment->update($request->all());
        return response()->json($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $user = Auth::user();

        // Check if the user has the 'delete comments' permission
        if (!$user->can('delete comments')) {
            return response()->json(['error' => 'Unauthorized to delete comments'], 403);
        }
        $comment->delete();
        return response()->json(['message' => 'Comment deleted']);
    }
}
/**--------------------------|
 * created by : Adil radidi  |
 * 16 august 2024            |
 * managment Comments        |
 *---------------------------| 
 */