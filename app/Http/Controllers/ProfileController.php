<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Update the user's name
    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->save();

        return response()->json($user);
    }

    // Update the user's email
    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->email = $request->input('email');
        $user->save();

        return response()->json($user);
    }

    // Update the user's password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json($user);
    }

    // Update the user's bio
    public function updateBio(Request $request)
    {
        $request->validate([
            'bio' => 'required|string|max:1000',
        ]);

        $user = Auth::user();
        $user->bio = $request->input('bio');
        $user->save();

        return response()->json($user);
    }

    // Update the user's profile picture
    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Delete old profile picture if exists
        if ($user->profile_picture) {
            Storage::delete($user->profile_picture);
        }

        // Store new profile picture
        $path = $request->file('profile_picture')->store('profile_pictures');
        $user->profile_picture = $path;
        $user->save();

        return response()->json($user);
    }

    // Delete the user's account
    public function deleteAccount(Request $request)
    {
        $user = Auth::user();
        $user->delete();
        return response()->json(['message' => 'Account deleted successfully']);
    }

    // Update the user's website
    public function updateWebsite(Request $request)
    {
        $request->validate([
            'website' => 'required|url',
        ]);

        $user = Auth::user();
        $user->website = $request->input('website');
        $user->save();

        return response()->json($user);
    }

    // Update the user's location
    public function updateLocation(Request $request)
    {
        $request->validate([
            'location' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->location = $request->input('location');
        $user->save();

        return response()->json($user);
    }

    // Update the user's position
    public function updatePosition(Request $request)
    {
        $request->validate([
            'position' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->position = $request->input('position');
        $user->save();

        return response()->json($user);
    }
    // updaste brand_color
    public function updateBrandColor(Request $request){
        $request->validate(
            [
                'brand_color' => 'required|string',
            ]);
            $user = Auth::user();
            $user->brand_color = $request->input('brand_color');
            $user->save();

            return response()->json($user);
    }
}
