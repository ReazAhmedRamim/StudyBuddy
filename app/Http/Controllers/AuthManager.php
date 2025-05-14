<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller
{
    public function registration()
    {
        return view('registration');
    }
    
    
    
    public function registrationPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'role' => 'required|in:student,tutor',
            'present_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'profile_photo' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'password' => 'required|string|min:8|confirmed',
            'student_id_card' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'education_certificate' => 'nullable|mimes:pdf,jpg,png,jpeg|max:2048',
            'nid_card' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $profilePhoto = $request->file('profile_photo')->store('public/profile_photos');

        $studentIdCard = null;
        if ($request->role === 'student' && $request->hasFile('student_id_card')) {
            $studentIdCard = $request->file('student_id_card')->store('public/student_id_cards');
        }

        $educationCertificate = null;
        $nidCard = null;
        if ($request->role === 'tutor') {
            if ($request->hasFile('education_certificate')) {
                $educationCertificate = $request->file('education_certificate')->store('public/education_certificates');
            }
            if ($request->hasFile('nid_card')) {
                $nidCard = $request->file('nid_card')->store('public/nid_cards');
            }
        }

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'role' => $request->role,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'profile_photo' => $profilePhoto,
            'student_id_card' => $studentIdCard,
            'education_certificate' => $educationCertificate,
            'nid_card' => $nidCard,
            'password' => Hash::make($request->password),
            'approval_status' => User::STATUS_PENDING,
        ];

        if ($request->role === 'student') {
            $userData['school_name'] = $request->school_name;
            $userData['class'] = $request->class;
            $userData['subject_interest'] = $request->subject_interest;
            $userData['learning_mode'] = $request->learning_mode;
        }

        if ($request->role === 'tutor') {
            $userData['qualification'] = $request->qualification;
            $userData['graduation_institution'] = $request->graduation_institution;
            $userData['experience'] = $request->experience;
            $userData['specialization'] = $request->specialization;
            $userData['teaching_mode'] = $request->teaching_mode;
        }

        User::create($userData);

        return redirect()->route('login')->with('success', 'Registration successful! Please wait for admin approval.');
    }

   

    public function login()
    {
        return view('login'); // Matches resources/views/login.blade.php
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if user is approved
            if ($user->approval_status !== User::STATUS_APPROVED) {
                Auth::logout(); // Log them out immediately
                return redirect()->route('login')->withErrors([
                    'email' => 'Your account is pending approval by the admin.',
                ]);
            }

            $request->session()->regenerate();

            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->isTutor()) {
                return redirect()->route('tutor.dashboard');
            } elseif ($user->isStudent()) {
                return redirect()->route('student.dashboard');
            }

            Auth::logout(); // fallback: logout if no matching role
            return redirect()->route('login')->withErrors([
                'email' => 'Unauthorized role.',
            ]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
