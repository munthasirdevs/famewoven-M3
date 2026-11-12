<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        $roles = User::roles();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => ['required', Rule::in([User::ROLE_SUPER_ADMIN, User::ROLE_ADMIN, User::ROLE_EDITOR, User::ROLE_VIEWER])],
            'password' => ['required', Password::min(8)],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => strtolower($validated['email']),
            'role' => $validated['role'],
            'status' => 'active',
            'password' => Hash::make($validated['password']),
        ]);

        ActivityLogger::log(
            'admin.user_created',
            "Created staff user {$user->name} ({$user->email}) with role {$user->role}",
            ['id' => $user->id, 'role' => $user->role]
        );

        return back()->with('success', "Staff account for {$user->name} created successfully.");
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'role' => ['required', Rule::in([User::ROLE_SUPER_ADMIN, User::ROLE_ADMIN, User::ROLE_EDITOR, User::ROLE_VIEWER])],
            'status' => ['required', Rule::in(['active', 'suspended'])],
        ]);

        // Safety: Prevent current user from suspending themselves
        if ($user->id === Auth::id() && $validated['status'] === 'suspended') {
            return back()->with('error', 'You cannot suspend your own active administrative session.');
        }

        $oldRole = $user->role;
        $oldStatus = $user->status;

        $user->update($validated);

        ActivityLogger::log(
            'admin.user_updated',
            "Updated user {$user->name}: role ({$oldRole} -> {$user->role}), status ({$oldStatus} -> {$user->status})",
            ['id' => $user->id, 'role' => $user->role, 'status' => $user->status]
        );

        return back()->with('success', "Account {$user->name} updated successfully.");
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own administrative account.');
        }

        $userName = $user->name;
        $userEmail = $user->email;
        $user->delete();

        ActivityLogger::log('admin.user_deleted', "Deleted user {$userName} ({$userEmail})");

        return back()->with('success', "User {$userName} has been removed.");
    }
}
