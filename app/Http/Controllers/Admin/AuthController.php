<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Display the dark-themed Admin login view.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    /**
     * Handle admin login authentication.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            if (!$user->isActive()) {
                Auth::logout();
                ActivityLogger::log('auth.failed', "Suspended user attempted login: {$request->email}", ['email' => $request->email]);

                return back()->withErrors([
                    'email' => 'Your account has been deactivated. Please contact an administrator.',
                ])->withInput($request->only('email'));
            }

            $user->update([
                'last_login_at' => now(),
                'last_login_ip' => $request->ip(),
            ]);

            $request->session()->regenerate();

            ActivityLogger::log(
                'auth.login',
                "User {$user->name} ({$user->role}) authenticated successfully",
                ['role' => $user->role, 'email' => $user->email],
                $user
            );

            return redirect()->intended(route('admin.dashboard'))->with('success', "Welcome back, {$user->name}.");
        }

        ActivityLogger::log('auth.failed', "Failed admin login attempt for: {$request->email}", ['email' => $request->email]);

        return back()->withErrors([
            'email' => 'These credentials do not match our records or account access is restricted.',
        ])->withInput($request->only('email'));
    }

    /**
     * Display the dark-themed Admin sign-up view.
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.register');
    }

    /**
     * Handle new user registration with role assignment.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        // First user created becomes super_admin if none exists, otherwise default to editor
        $isFirstUser = User::count() === 0;
        $role = $isFirstUser ? User::ROLE_SUPER_ADMIN : User::ROLE_EDITOR;

        $user = User::create([
            'name' => $validated['name'],
            'email' => strtolower($validated['email']),
            'password' => Hash::make($validated['password']),
            'role' => $role,
            'status' => 'active',
            'last_login_at' => now(),
            'last_login_ip' => $request->ip(),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        ActivityLogger::log(
            'auth.register',
            "New admin account registered: {$user->name} with role {$user->role}",
            ['role' => $user->role, 'email' => $user->email],
            $user
        );

        return redirect()->route('admin.dashboard')->with('success', "Account created successfully. Welcome to Famewoven Admin, {$user->name}!");
    }

    /**
     * Log out of the admin panel.
     */
    public function logout(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            ActivityLogger::log('auth.logout', "User {$user->name} signed out", ['email' => $user->email], $user);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'You have been signed out.');
    }
}
