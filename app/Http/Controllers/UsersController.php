<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Register;

class UsersController extends Controller
{
    public function index()
    {
        $users = Register::orderBy('created_at', 'desc')->get();
        return view('admin.user', compact('users'));
    }

    public function edit($id)
    {
        $user = Register::findOrFail($id);
        return view('admin.edit-user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:registers,email,' . $id,
        ]);

        $user = Register::findOrFail($id);
        $user->update($request->only('name', 'email'));

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        $user = Register::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }

    public function toggleStatus($id)
    {
        $user = Register::findOrFail($id);
        $user->status = !$user->status; // Toggle status
        $user->save();

        $message = $user->status ? 'User activated successfully!' : 'User deactivated successfully!';
        return redirect()->route('users.index')->with('success', $message);
    }
}
