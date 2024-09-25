<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification; // Import the Notification model

class FollowController extends Controller
{
    public function follow($id)
    {
        $userToFollow = User::find($id);

        if (!$userToFollow) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $currentUser = auth()->user();

        if (!$currentUser->isFollowing($userToFollow)) {
            $currentUser->follow($userToFollow);

            // Create a follow notification
            Notification::create([
                'user_id' => $userToFollow->id, // Notify the user being followed
                'username' => $currentUser->name,
                'action' => 'followed you',
                'time' => now()->diffForHumans(),
                'profile_picture' => $currentUser->profile_picture,
                'type' => 'follow',
                'read' => false,
            ]);

            return response()->json(['message' => 'User followed successfully'], 201);
        }

        return response()->json(['message' => 'You are already following this user']);
    }

    public function unfollow($id)
    {
        $userToUnfollow = User::find($id);

        if (!$userToUnfollow) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $currentUser = auth()->user();

        if ($currentUser->isFollowing($userToUnfollow)) {
            $currentUser->unfollow($userToUnfollow);
            return response()->json(['message' => 'User unfollowed successfully']);
        }

        return response()->json(['message' => 'You are not following this user']);
    }

    public function followers($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user->followers);
    }

    public function following($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user->following);
    }

    public function isFollowing($id)
    {
        $userToCheck = User::find($id);

        if (!$userToCheck) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $currentUser = auth()->user();
        $isFollowing = $currentUser->isFollowing($userToCheck);

        return response()->json(['is_following' => $isFollowing]);
    }
}
