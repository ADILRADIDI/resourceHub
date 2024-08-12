<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // List all posts
    public function index()
    {
        // Jib kolchi posts mn base donne
        $posts = Post::all();
        return response()->json($posts);
    }

    // Show a single post
    public function show($id)
    {
        // Jib post b id
        // Fetch post by ID
        $post = Post::find($id);

        // Check if post exists
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json($post);
    }

    // FUNCTION for create new posts
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:active,non-active,non-accept',
        ]);

        // Create post in DB
        $post = Post::create($request->all());

        return response()->json($post, 201);
    }

    // Update an existing post
    public function update(Request $request, $id)
    {
        // Validate request data
        $request->validate([
            'title' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'image' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
            'status' => 'nullable|in:active,non-active,non-accept',
        ]);

        // Find post
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // Update post
        $post->update($request->all());

        return response()->json($post);
    }

    // Delete a post
    public function destroy($id)
    {
        // Find post
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // Delete post
        $post->delete();

        return response()->json(['message' => 'Post deleted']);
    }
}
