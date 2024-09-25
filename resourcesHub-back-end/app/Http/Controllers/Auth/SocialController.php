<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SocialController extends Controller
{
    // GitHub Redirect
    public function redirectToGitHub()
    {
        return Socialite::driver('github')->redirect();
    }

    // GitHub Callback
    public function handleGitHubCallback()
    {
        $githubUser = Socialite::driver('github')->user();
        $user = $this->findOrCreateUser($githubUser, 'github');

        Auth::login($user);

        return redirect()->intended('dashboard');
    }

    // Google Redirect
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Google Callback
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = $this->findOrCreateUser($googleUser, 'google');

        Auth::login($user);

        return redirect()->intended('dashboard');
    }

    // GitLab Redirect
    public function redirectToGitLab()
    {
        return Socialite::driver('gitlab')->redirect();
    }

    // GitLab Callback
    public function handleGitLabCallback()
    {
        $gitlabUser = Socialite::driver('gitlab')->user();
        $user = $this->findOrCreateUser($gitlabUser, 'gitlab');

        Auth::login($user);

        return redirect()->intended('dashboard');
    }

    // Find or create a user
    public function findOrCreateUser($providerUser, $provider)
    {
        $user = User::where('provider_id', $providerUser->getId())->first();

        if (!$user) {
            $user = User::create([
                'name' => $providerUser->getName() ?? $providerUser->getNickname(),
                'email' => $providerUser->getEmail(),
                'provider' => $provider,
                'provider_id' => $providerUser->getId(),
                'password' => Hash::make(Str::random(16)),
            ]);
        }

        return $user;
    }
}
