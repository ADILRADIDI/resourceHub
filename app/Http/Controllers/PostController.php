<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    // List all posts i have
    public function index()
    {
        $user = Auth::user();

        // Check if the user has the 'view posts' permission
        if (!$user->can('view posts')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        // Jib kolchi posts mn base donne
        $posts = Post::with('tags')->get();
        return response()->json($posts);
    }


    // Show a single post by /{id}
    public function show($id)
    {
        // Find the post by ID and load its tags
        $post = Post::with('tags')->find($id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        return response()->json($post);
    }

    // FUNCTION for create new posts
    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if this user has the 'create posts' permission
        if (!$user->can('create posts')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $userId = Auth::id();
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|string',
            'tags' => 'array', 
            'tags.*' => 'exists:tags,id',
        ]);

        // Create the post
        $post = Post::create($request->only('title', 'body', 'image')
         + ['user_id' => Auth::id(), 'status' => $request->input('status', 'active')]);

        // Attach tags to the post
        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }

        return response()->json($post->load('tags'), 201);
    }


    // Update an existing post
    public function update(Request $request, $id)
    {   
        // get user is auth now
        $user = Auth::user();

        // Check if this user has the 'edit posts' permissions
        if (!$user->can('edit posts')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        //validate request data
        $request->validate([
            'title' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'image' => 'nullable|string',
            'status' => 'nullable|in:active,non-active,non-accept',
        ]);

        // Find post by {id}
        $post = Post::find($id);

        // check $post is empty => post not found..
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // update post
        $post->update($request->all());
        return response()->json($post);
    }

    // delete a post
    public function destroy($id)
    {
        $user = Auth::user();
 
        // Check if the user has the 'delete posts' permission
        if (!$user->can('delete posts')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        // Find post by id for remove
        $post = Post::find($id); 

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        } 
        // Delete post
        $post->delete();
        // return message succerss remove this post
        return response()->json(['message' => 'Post deleted']);
    }
}

/**--------------------------|
 * created by : Adil radidi  |
 * 16 august 2024            |
 *---------------------------| 
 */