<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserAdded;

class UserController extends Controller
{
    public function index()
    {
        // Retrieve all users and return as JSON
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the authenticated user has permission to add users
        if (!$user || !$user->hasPermissionTo('add users', 'web')) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        // Validate the request
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|exists:roles,name', // Validate that the role exists
        ]);

        // Create the new user
        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Assign the chosen role to the newly created user
        $newUser->assignRole($request->role);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $newUser
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the authenticated user has permission to edit users
        if (!$user || !$user->hasPermissionTo('edit users', 'web')) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        // Validate the request
        $request->validate([
            'name' => 'string|nullable',
            'email' => 'string|email|nullable',
            'role' => 'string|nullable|exists:roles,name', // Validate the role if provided
        ]);

        // Find the user to update
        $userToUpdate = User::find($id);

        if (!$userToUpdate) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update user details
        $userToUpdate->update($request->only(['name', 'email']));

        // Assign the new role if provided
        if ($request->has('role')) {
            $userToUpdate->syncRoles($request->role);
        }

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $userToUpdate
        ]);
    }

    public function destroy($id)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the authenticated user has permission to delete users
        if (!$user || !$user->hasPermissionTo('delete users', 'web')) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        // Find the user to delete
        $userToDelete = User::find($id);

        if (!$userToDelete) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Delete the user
        $userToDelete->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
