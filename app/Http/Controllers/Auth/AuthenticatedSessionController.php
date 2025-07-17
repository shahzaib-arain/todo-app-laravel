<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show the login form.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login request and redirect based on user role.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate login credentials
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Safely access the role name if it exists
            $roleName = strtolower(optional($user->role)->name); // assuming $user->role is a relationship

            // Redirect based on role
            return match ($roleName) {
                'admin' => redirect()->route('dashboard.admin'),
                'pm', 'project_manager' => redirect()->route('dashboard.pm'),
                'user' => redirect()->route('dashboard.user'),
                'viewer' => redirect()->route('dashboard.viewer'),
                default => $this->handleUnauthorized($request),
            };
        }

        // Failed login
        return back()->withErrors([
            'email' => 'Invalid credentials. Please try again.',
        ]);
    }

    /**
     * Handle unauthorized roles
     */
    protected function handleUnauthorized(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('error', 'Unauthorized role or access denied.');
    }

    /**
     * Logout the user and destroy session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
