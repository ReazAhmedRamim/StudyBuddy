<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;

class TutorProfileController extends Controller
{
    public function setting()
    {
        return view('tutor.profile.setting');
    }



    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Handle file uploads
        $profilePhoto = $request->hasFile('photo') ? $request->file('photo')->store('profile_photos', 'public') : $user->profile_photo;
        $educationCertificate = $request->hasFile('education_certificate') ? $request->file('education_certificate')->store('certificates', 'public') : $user->education_certificate;
        $nidCard = $request->hasFile('nid_card') ? $request->file('nid_card')->store('nid_cards', 'public') : $user->nid_card;

        // Fill data
        $user->fill([
            'name' => $request->name,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'qualification' => $request->qualification,
            'graduation_institution' => $request->graduation_institution,
            'experience' => $request->experience,
            'specialization' => $request->specialization,
            'teaching_mode' => $request->teaching_mode,
            'profile_photo' => $profilePhoto,
        ]);

        if ($request->password) {
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
