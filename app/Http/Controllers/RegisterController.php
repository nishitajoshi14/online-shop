<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:registers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $otp = rand(100000, 999999);

        $user = Register::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Your OTP for Email Verification');
        });

        return redirect()->route('otp.form')
            ->with(['success' => 'Registration successful! Enter the OTP sent to your email to verify your account.', 'email' => $user->email]);
    }

    public function showOtpForm()
    {
        return view('auth.otp-form');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric',
        ]);

        $user = Register::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'No account found with this email.');
        }

        if ($user->otp != $request->otp) {
            return back()->with('error', 'Invalid OTP.');
        }

        if ($user->otp_expires_at && now()->greaterThan($user->otp_expires_at)) {
            return back()->with('error', 'OTP has expired.');
        }

        $user->update([
            'verified_at' => now(),
            'otp' => null,
            'otp_expires_at' => null,
        ]);

        return redirect()->route('login.form')
            ->with('success', 'Email verified successfully! You can now log in.');
    }
}
