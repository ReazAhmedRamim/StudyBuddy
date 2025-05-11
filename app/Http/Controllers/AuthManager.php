<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller
{
    public function registration()
    {
        return view('registration');
    }

    public function registrationPost(Request $request)
    {
        $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|string|confirmed|min:8',
            'phone'                 => 'required|digits:11',
            'dob'                   => 'required|date',
            'gender'                => 'required|in:male,female,other',
            'user_type'             => 'required|in:student,tutor',
            'profile_photo'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'school_name'           => 'nullable|string|max:255',
            'class'                 => 'nullable|string|max:50',
            'subject_interest'      => 'nullable|string|max:255',
            'learning_mode'         => 'nullable|string|max:255',
            'qualification'         => 'nullable|string|max:255',
            'graduation_institution'=> 'nullable|string|max:255',
            'experience'            => 'nullable|string|max:255',
            'specialization'        => 'nullable|string|max:255',
            'teaching_mode'         => 'nullable|string|max:255',
            'present_address'       => 'nullable|string|max:500',
            'permanent_address'     => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('profile_photo')) {
            $validated['profile_photo'] = $request->file('profile_photo')
                ->store('profile_photos', 'public');
        }

        $user = User::create(array_merge($validated, [
            'password' => Hash::make($validated['password']),
            'status'   => User::STATUS_PENDING,
            'banned'   => false,
            'role'     => $validated['user_type'],
        ]));

        return redirect()->route('login')
                         ->with('status', 'Registration successful. Awaiting admin approval.');
    }

    public function login()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->regenerate();

            if ($user->banned) {
                Auth::logout();
                return back()->withErrors(['email' => 'Account banned']);
            }

            if (! $user->isAdmin() && ! $user->isApproved()) {
                Auth::logout();
                return back()->withErrors(['email' => 'Account pending approval']);
            }

            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended(route('home'));
        }

        return back()->withErrors(['email' => 'Invalid credentials'])
                     ->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
