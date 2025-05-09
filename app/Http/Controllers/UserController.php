<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function chatbox()
    {
        $users = User::query()        // exclude yourself
        ->where('user_type', 'student')             // only tutors
        ->withCount('unreadMessages')             // eager‑load unread count
        ->get();

    return view('tutor.chatbox.index', compact('users'));
    }

    public function chatbox_student()
    {
        $users = User::query()        // exclude yourself
        ->where('user_type', 'tutor')             // only tutors
        ->withCount('unreadMessages')             // eager‑load unread count
        ->get();

    return view('student.chatbox.index', compact('users'));
    }

    public function userChat($userId)
    {
        return view('user-chat', compact('userId'));
    }
}
