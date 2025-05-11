<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;

class StudentProfileController extends Controller
{
    public function setting()
    {
        return view('student.profile.setting');
    }



    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        
            $user = Auth::user();
        
            // Handle profile photo upload
            $profilePhoto = $request->hasFile('photo') 
                ? $request->file('photo')->store('profile_photos', 'public') 
                : $user->profile_photo;

            // Fill student-specific data
            $user->fill([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'present_address' => $request->present_address,
                'permanent_address' => $request->permanent_address,
                'school_name' => $request->school_name,
                'class' => $request->class,
                'subject_interest' => $request->subject_interest,
                'learning_mode' => $request->learning_mode,
                'profile_photo' => $profilePhoto,
            ]);
        
            // If password is provided, update it
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
        
            $user->save();
        
            return redirect()->back()->with('success', 'Profile updated successfully.');
        
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed'], // validates new_password + new_password_confirmation
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Current password is incorrect.',
            ]);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();


        return back()->with('success', 'Password updated successfully!');
    }
}
