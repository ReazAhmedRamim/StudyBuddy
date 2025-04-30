<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\session;

class AuthManager extends Controller
{
    //use App\Models\Course;
    //use Illuminate\Support\Facades\Auth;

    function login(){
        return view('login');
    }

    function registration(){
        return view('registration');
    }

    function student(){
        $student = Auth::user();
        $courses = Course::all();
        $enrolledCourseIds = $student->courses()->pluck('courses.id')->toArray();
        return view('student.dashboard.index',compact('student', 'courses', 'enrolledCourseIds'));
    }

    function tutor(){
        $tutor = Auth::user();
        return view('tutor.dashboard.index',compact('tutor'));
    }

    function admin(){
        $admin = Auth::user();
        return view('admin.dashboard.index',compact('admin'));
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        $credentials = $request->only('email','password');
    
        if(Auth::attempt($credentials)){
            $user = Auth::user();
    
            if ($user->user_type === 'student') {
                return redirect()->intended(route('student')); // change route name as needed
            } elseif ($user->user_type === 'tutor') {
                return redirect()->intended(route('tutor')); // change route name as needed
            } elseif ($user->user_type === 'admin') {
                return redirect()->intended(route('admin')); // change route name as needed
            } 
            else {
                Auth::logout();
                return redirect(route('login'))->with("error", "User type not recognized.");
            }
        }
    
        return redirect(route('login'))->with("error","Your login details are not valid");
    }

    function registrationPost(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'user_type' => 'required|in:student,tutor',
            'present_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'profile_photo' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'password' => 'required|string|min:8|confirmed',
            'student_id_card' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'education_certificate' => 'nullable|mimes:pdf,jpg,png,jpeg|max:2048',
            'nid_card' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);
        // Handle file uploads
        $profilePhoto = $request->file('profile_photo')->store('public/profile_photos');

        $studentIdCard = null;
        if ($request->user_type === 'student' && $request->hasFile('student_id_card')) {
            $studentIdCard = $request->file('student_id_card')->store('public/student_id_cards');
        }

        $educationCertificate = null;
        $nidCard = null;
        if ($request->user_type === 'tutor') {
            if ($request->hasFile('education_certificate')) {
                $educationCertificate = $request->file('education_certificate')->store('public/education_certificates');
            }
            if ($request->hasFile('nid_card')) {
                $nidCard = $request->file('nid_card')->store('public/nid_cards');
            }
        }

        // Create the user
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'user_type' => $request->user_type,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'profile_photo' => $profilePhoto,
            'student_id_card' => $studentIdCard,
            'education_certificate' => $educationCertificate,
            'nid_card' => $nidCard,
            'password' => Hash::make($request->password),
        ];
        
        // Student-specific
        if ($request->user_type === 'student') {
            $userData['school_name'] = $request->school_name;
            $userData['class'] = $request->class;
            $userData['subject_interest'] = $request->subject_interest;
            $userData['learning_mode'] = $request->learning_mode;
        }
        
        // Tutor-specific
        if ($request->user_type === 'tutor') {
            $userData['qualification'] = $request->qualification;
            $userData['graduation_institution'] = $request->graduation_institution;
            $userData['experience'] = $request->experience;
            $userData['specialization'] = $request->specialization;
            $userData['teaching_mode'] = $request->teaching_mode;
        }
        
        // Finally, create the user
        $user = User::create($userData);
        

        return redirect()->route('login')->with('success', 'Registration successful! Login to see your profile.');

    }

    function logout()
{
    // // @phpstan-ignore-next-line
    // session()->flush();

    
    // Log out the user from the Auth system
    Auth::logout();
    
    // Redirect to the login page
    return redirect()->route('login');
}

    

}
