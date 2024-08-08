<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginNotification;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign the 'user' role to the user
        $role = Role::firstOrCreate(['name' => 'user']);
        $user->assignRole($role);

        // Generate API token for the user
        $token = $user->createToken('auth_token')->plainTextToken;
        // Get the users roles and permissions
        $roles = $user->getRoleNames();
        $permissions = $user->getAllPermissions()->pluck('name');

        return response()->json([
            'message' => 'User registered successfully',
            'token' => $token,
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists and the password is correct
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Generate API token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Get the user's roles and permissions
        $roles = $user->getRoleNames();
        $permissions = $user->getAllPermissions()->pluck('name');
        // send notification email in login
        Mail::to($user->email)->send(new LoginNotification($user));      
        return response()->json([
            'token' => $token,
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function logout(Request $request)
    {
        // Revoke the current user's token
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

    public function user(Request $request)
    {
        // Return the authenticated user's information
        return response()->json($request->user());
    }
}
