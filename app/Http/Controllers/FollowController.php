<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowController extends Controller
{
    public function follow($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if (!auth()->user()->isFollowing($user)) {
            auth()->user()->follow($user);
            return response()->json(['message' => 'User followed successfully']);
        }

        return response()->json(['message' => 'You are already following this user']);
    }

    public function unfollow($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if (auth()->user()->isFollowing($user)) {
            auth()->user()->unfollow($user);
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
}
