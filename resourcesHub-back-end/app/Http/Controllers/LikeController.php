<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Notification; // Import the Notification model
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();
        $postId = $request->input('post_id');

        // Validate post_id
        if (!$postId) {
            return response()->json(['message' => 'Post ID is required'], 400);
        }

        // Find the post
        $post = Post::find($postId);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // Check if the user has already liked this post
        if ($post->likes()->where('user_id', $user->id)->exists()) {
            return response()->json(['message' => 'You have already liked this post'], 400);
        }

        // Create a like record
        $like = $post->likes()->create([
            'user_id' => $user->id,
        ]);

        // Create a like notification
        Notification::create([
            'user_id' => $post->user_id, // Assuming the post has a user_id to notify the author
            'username' => $user->name,
            'action' => 'liked your post',
            'time' => now()->diffForHumans(),
            'profile_picture' => $user->profile_picture,
            'post_link' => '/posts/' . $postId,
            'type' => 'like',
            'read' => false,
        ]);

        return response()->json(['message' => 'Post liked successfully'], 201);
    }

    public function destroy(Request $request)
    {
        $user = auth()->user();
        $postId = $request->input('post_id');

        // Validate post_id
        if (!$postId) {
            return response()->json(['message' => 'Post ID is required'], 400);
        }

        // Find the post
        $post = Post::find($postId);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // Check if the user has liked this post
        $like = $post->likes()->where('user_id', $user->id)->first();
        if (!$like) {
            return response()->json(['message' => 'You have not liked this post'], 400);
        }

        // Delete the like record
        $like->delete();

        return response()->json(['message' => 'Post unliked successfully']);
    }
}
