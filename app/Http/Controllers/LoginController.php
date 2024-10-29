<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('login'); // Return the 'login.blade.php' view
    }

    // Handle login logic
    public function login(Request $request)
    {
        // Validate the login form inputs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the email exists in the "registers" table
        $user = Register::where('email', $request->email)->first();

        // Check if the user is admin and verify the password
        if ($user && Hash::check($request->password, $user->password)) {
            // If credentials match and user is the admin, store the login record
            if ($request->email === 'admin@surfsidemedia.in') {
                Login::create([
                    'email' => $request->email,
                    'logged_in_at' => now(),
                ]);

                // Set a session variable to keep the user logged in
                Session::put('user', $request->email);

                // Redirect to the admin dashboard
                return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
            }
        }

        // If the credentials don't match, redirect to the main home page
        return redirect()->route('home')->with('error', 'Invalid email or password.');
    }

    // Add this method to your LoginController
public function logout()
{
    // Clear the user session
    Session::forget('user');

    // Redirect to the home page or login page with a success message
    return redirect()->route('home')->with('success', 'Logged out successfully!');
}


}
