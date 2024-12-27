<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); 
    }

    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Special handling for admin
        if ($request->email === 'admin@surfsidemedia.in' && $request->password === '12345678') {
            // Find admin user or create if not found
            $adminUser = Login::where('email', 'admin@surfsidemedia.in')->first();
            if (!$adminUser) {
                // Create admin account if it doesn't exist
                $adminUser = Login::create([
                    'email' => 'admin@surfsidemedia.in',
                    'password' => Hash::make('12345678'), // Hash the admin password
                    'logged_in_at' => Carbon::now(),
                ]);
            }

            // Log admin in
            $adminUser->update(['logged_in_at' => Carbon::now()]);
            Session::put('user', $adminUser);
            Session::put('username', 'Admin');

            // Redirect to admin dashboard
            return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
        }

        // Check if user exists in the database
        $existingUser = Login::where('email', $request->email)->first();

        // If user exists, verify password
        if ($existingUser) {
            // Check if the entered password matches the stored password
            if (Hash::check($request->password, $existingUser->password)) {
                // Update the last logged-in time
                $existingUser->update(['logged_in_at' => Carbon::now()]);

                // Store user session data
                Session::put('user', $existingUser);
                Session::put('username', explode('@', $request->email)[0]);

                // Redirect to user dashboard
                return redirect()->route('user.dashboard')->with('success', 'Login successful');
            } else {
                // Password mismatch
                return back()->withErrors(['password' => 'Invalid password.']);
            }
        }

        // If the user doesn't exist, create a new record and log them in
        $newUser = Login::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),  // Hash the password
            'logged_in_at' => Carbon::now(),
        ]);

        // Store new user session data
        Session::put('user', $newUser);
        Session::put('username', explode('@', $request->email)[0]);

        // Redirect to user dashboard
        return redirect()->route('user.dashboard')->with('success', 'New user created and logged in');
    }

    public function logout()
    {
        // Clear user session data on logout
        Session::forget('user');
        Session::forget('username');
        Session::forget('cart');

        // Redirect to login page after logout
        return redirect()->route('login.form')->with('success', 'Logged out successfully');
    }

    public function myAccount()
    {
        // Retrieve logged-in user
        $user = Session::get('user');

        if ($user && $user->email === 'admin@surfsidemedia.in') {
            return redirect()->route('admin.dashboard');
        } elseif ($user) {
            return redirect()->route('user.dashboard');
        }

        return redirect()->route('login.form')->with('error', 'Please log in first.');
    }
}
