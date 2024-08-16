<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{// In your GoogleController
public function redirectToGoogle()
{
    return Socialite::driver('google')->redirect();
}

public function handleGoogleCallback(Request $request)
{
    try {
        $googleUser = Socialite::driver('google')->stateless()->user();  // Use stateless() if sessions are not used
        // Handle user login or registration here
    } catch (\Exception $e) {
        \Log::error('Google authentication failed', ['exception' => $e->getMessage()]);
        return response()->json(['error' => 'Failed to authenticate with Google'], 500);
    }
}

}
