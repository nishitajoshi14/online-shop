<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Check if the user exists
        $user = Login::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'No account found with that email.');
        }

        // Generate a reset token
        $token = Str::random(64);

        // Store token in the database (you can create a `password_resets` table)
        \DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        // Send reset link via email
        Mail::send('emails.password-reset', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Password Reset Request');
        });

        return back()->with('success', 'We have emailed your password reset link!');
    }

    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        // Verify token
        $resetRecord = \DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();

        if (!$resetRecord) {
            return back()->with('error', 'Invalid token or email.');
        }

        // Update user password
        $user = Login::where('email', $request->email)->first();
        if ($user) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        // Delete reset token
        \DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('login.form')->with('success', 'Password has been reset successfully!');
    }
}
