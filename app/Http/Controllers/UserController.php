<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showUpdateForm()
    {
        $user = Auth::user();
        return view('auth.update_name', compact('user'));
    }

    // app/Http/Controllers/UserController.php

// ... Existing methods ...

public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:8|confirmed',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('home');
}
    
public function updateAdminStatus(Request $request)
{
    // Validate the selected_users array in the form submission
    $request->validate([
        'selected_users' => 'required|array',
    ]);

    // Get the selected user IDs from the form submission
    $selectedUserIds = $request->input('selected_users', []);

    // Update the "is_admin" value for selected users to 1 (assuming your column name is "is_admin")
    User::whereIn('id', $selectedUserIds)->update(['is_admin' => 1]);

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Selected users have been updated as admins.');
}
}


