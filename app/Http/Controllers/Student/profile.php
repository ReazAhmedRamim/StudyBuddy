<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profile extends Controller
{
    public function index()
    {
        $student = Auth::user();
        return view('student.profile.index',compact('student'));
    }

}
