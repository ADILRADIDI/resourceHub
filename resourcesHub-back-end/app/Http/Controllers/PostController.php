<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
use App\Models\PostTag;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    // List all posts
    public function index()
    {
        $user = Auth::user();

        // Check if the user has the 'view posts' permission
        if (!$user->can('view posts')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Retrieve all posts along with user information, likes, & bookmarks
        $posts = Post::with(['user:id,name,profile_picture', 'likes', 'bookmarks'])
            ->where('status', 'published')
            ->get();

        // Map through posts to add saved status and tags for the authenticated user
        $postsWithSavedStatus = $posts->map(function ($post) use ($user) {
            // Fetch tags for each post individually
            $tagNames = $post->tags()->pluck('name')->toArray();

            return [
                'id' => $post->id,
                'title' => $post->title,
                'body' => $post->body,
                'created_at' => $post->created_at,
                'user' => $post->user,
                'tags' => $tagNames, // Get the tag names directly
                'likes' => $post->likes,
                'saved' => $post->bookmarks->contains('user_id', $user->id),
            ];
        });

        return response()->json($postsWithSavedStatus);
    }







    // Show a single post by ID
    public function show($id)
    {
        // Find the post by ID and load its tags
        $post = Post::with('user:id,name,profile_picture', 'likes', 'bookmarks', 'tags')->find($id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        return response()->json($post);
    }


    public function uploadImage($image)
    {
        // Store the image and return the path
        return $image->store('uploads/images', 'public');
    }



    // Create a new post
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user->can('create posts')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Custom validation logic to ensure only one file type is present
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|file|mimes:mp4,avi,mov|max:50000',
            'document' => 'nullable|file|mimes:doc,docx,xls,xlsx,ppt,pptx|max:10000',
            'pdf' => 'nullable|file|mimes:pdf|max:10000',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'status' => 'nullable|in:draft,published,archived',
        ]);

        // Custom validation to ensure only one of image, video, or pdf is provided
        if ($request->hasFile('image') && ($request->hasFile('video') || $request->hasFile('pdf'))) {
            return response()->json(['error' => 'Only one of image, video, or pdf can be uploaded.'], 422);
        }
        if ($request->hasFile('video') && $request->hasFile('pdf')) {
            return response()->json(['error' => 'Only one of image, video, or pdf can be uploaded.'], 422);
        }

        $data = $request->only('title', 'body', 'status');
        $data['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'));
        }
        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('uploads/videos', 'public');
        }
        if ($request->hasFile('document')) {
            $data['document'] = $request->file('document')->store('uploads/documents', 'public');
        }
        if ($request->hasFile('pdf')) {
            $data['pdf'] = $request->file('pdf')->store('uploads/pdfs', 'public');
        }

        $post = Post::create($data);

        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }

        return response()->json($post->load('tags'), 201);
    }



    // get post by tags in click tags i want it
    public function getPostsByTag(Request $request)
    {
        $tag = $request->input('tag');
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $posts = Post::with(['user:id,name,profile_picture', 'likes', 'bookmarks'])
            ->whereHas('tags', function ($query) use ($tag) {
                $query->where('name', $tag);
            })
            ->where('status', 'published')
            ->get();

        // Map through posts to add saved status for the authenticated user
        $postsWithSavedStatus = $posts->map(function ($post) use ($user) {
            // Fetch tags for each post individually
            $tagNames = $post->tags()->pluck('name')->toArray();

            return [
                'id' => $post->id,
                'title' => $post->title,
                'body' => $post->body,
                'created_at' => $post->created_at,
                'user' => $post->user,
                'tags' => $tagNames,
                'likes' => $post->likes,
                'saved' => $post->bookmarks->contains('user_id', $user->id) ?? false,
            ];
        });

        return response()->json($postsWithSavedStatus);
    }









    // function search ... (title or body post)
    public function search(Request $request)
    {
        // Validate the request
        $request->validate([
            'keyword' => 'required|string',
        ]);

        // Retrieve the search keyword from the request
        $keyword = $request->input('keyword');

        // Search for posts by title or body
        $posts = Post::where(function ($query) use ($keyword) {
            $query->where('title', 'like', '%' . $keyword . '%')
                ->orWhere('body', 'like', '%' . $keyword . '%');
        })
        ->get();

        return response()->json($posts);
    }

    // Update an existing post
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        // Check if the user has the 'edit posts' permission
        if (!$user->can('edit posts')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'image' => 'nullable|string',
            'video' => 'nullable|string',
            'document' => 'nullable|string',
            'pdf' => 'nullable|string',
            'status' => 'nullable|in:draft,published,archived',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        // Find post by ID
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // Update post
        $post->update($request->only('title', 'body', 'image', 'video', 'document', 'pdf', 'status'));

        // Sync tags with the post
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return response()->json($post->load('tags'));
    }

    // Delete a post
    public function destroy($id)
            {
                $user = Auth::user();

                // Check if the user has the 'delete posts' permission
                if (!$user->can('delete posts')) {
                    return response()->json(['error' => 'Unauthorized'], 403);
                }

                // Find post by ID
                $post = Post::find($id);
                if (!$post) {
                    return response()->json(['message' => 'Post not found'], 404);
                }

                // Delete associated files
                foreach (['image', 'video', 'document', 'pdf'] as $type) {
                    if ($post->$type) {
                        \Storage::disk('public')->delete($post->$type);
                    }
                }

                // Delete post
                $post->delete();

                return response()->json(['message' => 'Post deleted']);
            }

}

/**--------------------------|
 * created by : Adil Radidi  |
 * 16 August 2024            |
 *---------------------------|
 */
