<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class ProfileController extends Controller
{
    // get data user profil by id
    public function getUserProfile($userId)
    {
        // Find the user by ID
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Retrieve user's posts along with their tags
        $posts = $user->posts()->with(['tags', 'user:id,name,profile_picture'])->get();

        // Transform the posts to include tag names and user data
        $formattedPosts = $posts->map(function ($post) {
            // Check if tags is a collection and then get tag names
            $tagNames = collect($post->tags)->pluck('name'); // Use collect to ensure it's a collection

            return [
                'id' => $post->id,
                'title' => $post->title,
                'body' => $post->body,
                'image' => $post->image,
                'video' => $post->video,
                'document' => $post->document,
                'pdf' => $post->pdf,
                'tags' => $tagNames, // Get tag names
                'user' => [
                    'id' => $post->user->id,
                    'name' => $post->user->name,
                    'profile_picture' => $post->user->profile_picture,
                ],
                'status' => $post->status,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
            ];
        });

        // Return user data along with formatted posts
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'bio' => $user->bio,
            'profile_picture' => $user->profile_picture,
            'website' => $user->website,
            'skills' => $user->skills,
            'github' => $user->github,
            'location' => $user->location,
            'position' => $user->position,
            'brand_color' => $user->brand_color,
            'posts' => $formattedPosts,
        ]);
    }

    public function updateName(Request $request)
    {
        $user = Auth::user();
        $request->validate(['name' => 'required|string|max:255']);

        $user->name = $request->name;
        $user->save();

        return response()->json(['message' => 'Name updated successfully']);
    }

    public function updateEmail(Request $request)
    {
        $user = Auth::user();
        $request->validate(['email' => 'required|string|email|max:255|unique:users,email,' . $user->id]);

        $user->email = $request->email;
        $user->save();

        return response()->json(['message' => 'Email updated successfully']);
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Current password is incorrect'], 400);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();
        return response()->json(['message' => 'Password changed successfully']);
    }

    public function updateBio(Request $request)
    {
        $user = Auth::user();
        $request->validate(['bio' => 'nullable|string|max:500']);

        $user->bio = $request->bio;
        $user->save();

        return response()->json(['message' => 'Bio updated successfully']);
    }

    public function updateSkills(Request $request)
    {
        $user = Auth::user();
        $request->validate(['skills' => 'nullable|string|max:500']);

        $user->skills = $request->skills;
        $user->save();

        return response()->json(['message' => 'Skills updated successfully']);
    }

    public function updateGithub(Request $request)
    {
        $user = Auth::user();
        $request->validate(['github' => 'nullable|url|max:255']);

        $user->github = $request->github;
        $user->save();

        return response()->json(['message' => 'GitHub link updated successfully']);
    }

    public function updateProfilePicture(Request $request)
    {
        $user = Auth::user();
    
        // Validate the request for an image
        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('profile_picture')) {
            // Log that a file is being processed
            Log::info('Processing file upload for user ID: ' . $user->id);
    
            // Delete old profile picture if it exists
            if ($user->profile_picture) {
                // Use the storage disk to delete the old picture
                Storage::disk('public')->delete('uploads/profile_pictures/' . $user->profile_picture);
                Log::info('Deleted old profile picture from storage: ' . $user->profile_picture);
            }
    
            // Generate a unique filename and store the new picture in the storage
            $filename = time() . '.' . $request->file('profile_picture')->getClientOriginalExtension();
            $path = $request->file('profile_picture')->storeAs('uploads/profile_pictures', $filename, 'public');
    
            // Update user's profile picture path in the database
            $user->profile_picture = $filename; // Store just the filename in the database
            $user->save();
    
            Log::info('Profile picture updated to: ' . $filename);
        } else {
            Log::info('No file was uploaded.');
        }
    
        return response()->json(['message' => 'Profile picture updated successfully'], 200);
    }
    



    public function updateWebsite(Request $request)
    {
        $user = Auth::user();
        $request->validate(['website' => 'nullable|url|max:255']);

        $user->website = $request->website;
        $user->save();

        return response()->json(['message' => 'Website updated successfully']);
    }

    public function updateLocation(Request $request)
    {
        $user = Auth::user();
        $request->validate(['location' => 'nullable|string|max:255']);

        $user->location = $request->location;
        $user->save();

        return response()->json(['message' => 'Location updated successfully']);
    }

    public function updatePosition(Request $request)
    {
        $user = Auth::user();
        $request->validate(['position' => 'nullable|string|max:255']);

        $user->position = $request->position;
        $user->save();

        return response()->json(['message' => 'Position updated successfully']);
    }

    public function updateBrandColor(Request $request)
    {
        $user = Auth::user();
        $request->validate(['brand_color' => 'nullable|string|max:7']); // Assuming hex color code

        $user->brand_color = $request->brand_color;
        $user->save();

        return response()->json(['message' => 'Brand color updated successfully']);
    }

    public function updateBirthday(Request $request)
    {
        $user = Auth::user();
        $request->validate(['birthday' => 'nullable|date']);

        $user->birthday = $request->birthday;
        $user->save();

        return response()->json(['message' => 'Birthday updated successfully']);
    }

}
