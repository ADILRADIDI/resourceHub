<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use App\Mail\PasswordResetEmail;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    // Send a password reset link
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $response = Password::sendResetLink($request->only('email'));

        return $response === Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Password reset link sent.'], 200)
            : response()->json(['error' => 'Unable to send reset link.'], 500);
    }


    // Reset the password
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        // Use your custom table name
        $response = Password::broker()->reset(
            $request->only('email', 'password', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $response === Password::PASSWORD_RESET
            ? response()->json(['message' => 'Password has been reset.'], 200)
            : response()->json(['error' => 'Failed to reset password.'], 500);
    }

}
