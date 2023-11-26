<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }
    public function index()
    {
        $users = User::all();
        return view('manage_users.index', compact('users'));
    }

    public function updateRole(User $user)
    {
        // Validate and update the user's role
        $this->validate(request(), [
            'role' => 'required|in:admin,user',
        ]);

        $user->update(['role' => request('role')]);

        return back()->with('success', 'User role updated successfully.');
    }
}
