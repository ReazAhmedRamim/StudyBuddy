<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class TutorController extends Controller
{
    public function dashboard()
    {
        return view('tutor.dashboard.index');
    }
    public function approve($id)
    {
        $tutor = Tutor::findOrFail($id);
        $tutor->status = 'approved';
        $tutor->save();

        return back()->with('success', 'Tutor approved successfully.');
    }

    public function ban($id)
    {
        $tutor = Tutor::findOrFail($id);
        $tutor->status = 'banned';
        $tutor->save();

        return back()->with('success', 'Tutor banned successfully.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
