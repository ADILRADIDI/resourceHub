<?php

namespace App\Http\Controllers;

use App\Models\FollowTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowTagController extends Controller
{
    // Function to follow a tag
    public function follow($tagId)
    {
        $user = Auth::user();
        $tag = Tag::findOrFail($tagId);

        // Check if the user is already following the tag
        $existingFollow = FollowTag::where('user_id', $user->id)->where('tag_id', $tagId)->first();

        if ($existingFollow) {
            return response()->json(['message' => 'You are already following this tag.']);
        }

        // Create a new follow record
        FollowTag::create([
            'user_id' => $user->id,
            'tag_id' => $tag->id,
        ]);

        return response()->json(['message' => 'You are now following this tag.']);
    }

    // Function to unfollow a tag
    public function unfollow($tagId)
    {
        $user = Auth::user();
        $tag = Tag::findOrFail($tagId);

        // Find the follow record
        $follow = FollowTag::where('user_id', $user->id)->where('tag_id', $tagId)->first();

        if (!$follow) {
            return response()->json(['message' => 'You are not following this tag.']);
        }

        // Delete the follow record
        $follow->delete();

        return response()->json(['message' => 'You have unfollowed this tag.']);
    }

    public function isFollowing($tagId)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['isFollowing' => false]);
        }

        // Debugging output
        \Log::info('Checking following status for user ID: ' . $user->id . ' and tag ID: ' . $tagId);

        $isFollowing = FollowTag::where('user_id', $user->id)->where('tag_id', $tagId)->exists();

        // More debugging output
        \Log::info('Is following: ' . ($isFollowing ? 'true' : 'false'));

        return response()->json(['isFollowing' => $isFollowing]);
    }

}
