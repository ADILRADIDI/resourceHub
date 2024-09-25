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
        $userId = Auth::id();
        // Check if the user has the 'create comments' permission
        if (!$user->can('create comments')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'body' => 'required|string',
        ]);

        // Create a new comment in the database
        $comment = Comment::create([
            'post_id' => $request->post_id,
            'user_id' => $user->id, // Set user_id here
            'body' => $request->body,
        ]);

        // Return status 201 created and comment from JSON
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

    public function getCommentsByPostId($postId)
    {
        $user = Auth::user();

        // Check if the user has the 'view comments' permission
        if (!$user->can('view comments')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Validate if the post ID exists in the comments table
        $comments = Comment::with('user:id,name,profile_picture') // Eager load user
            ->where('post_id', $postId)
            ->get();

        // Check if comments exist for the post
        if ($comments->isEmpty()) {
            return response()->json(['error' => 'No comments found for this post'], 404);
        }

        // Format comments to include user name and profile image
        $formattedComments = $comments->map(function ($comment) {
            return [
                'id' => $comment->id,
                'body' => $comment->body,
                'created_at' => $comment->created_at,
                'user_id' => $comment->user_id,
                'username' => $comment->user->name, // User's name
                'profile_image' => $comment->user->profile_picture, // User's profile picture
            ];
        });

        return response()->json($formattedComments);
    }

}
/**--------------------------|
 * created by : Adil radidi  |
 * 16 august 2024            |
 * managment Comments        |
 *---------------------------|
 */
