<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('login'); // fixed view path
    }

    /**
     * Handle a login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            if (method_exists($user, 'hasAdminAccess') && $user->hasAdminAccess()) {
                return redirect()->route('admin.dashboard');
            } elseif (method_exists($user, 'isTutor') && $user->isTutor()) {
                return redirect()->route('tutor.dashboard');
            } elseif (method_exists($user, 'isStudent') && $user->isStudent()) {
                return redirect()->route('student.dashboard');
            }

            return redirect('/'); // fallback route
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
