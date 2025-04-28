<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProfile extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        return view('admin.profile.index',compact('admin'));
    }
}
