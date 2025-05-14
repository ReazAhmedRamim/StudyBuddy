<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    private function ensureAdmin()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }
    }

    public function dashboard()
    {
        $this->ensureAdmin();

        return view('admin.dashboard.index', [
            'tutors' => User::withCount('courses')
                ->where('role', 'tutor')
                ->where('approval_status', '!=', User::STATUS_BANNED)
                ->get(),

            'students' => User::withCount('enrollments')
                ->where('role', 'student')
                ->where('approval_status', '!=', User::STATUS_BANNED)
                ->get(),

            'pendingTutors' => User::where('role', 'tutor')->where('approval_status', User::STATUS_PENDING)->count(),
            'pendingStudents' => User::where('role', 'student')->where('approval_status', User::STATUS_PENDING)->count(),

            'bannedUsers' => User::where('approval_status', User::STATUS_BANNED)->get(),
            'bannedTutors' => User::where('role', 'tutor')->where('approval_status', User::STATUS_BANNED)->count(),
            'bannedStudents' => User::where('role', 'student')->where('approval_status', User::STATUS_BANNED)->count(),

            'activeCourses' => Course::where('status', 'active')->count(),
            'newCoursesThisMonth' => Course::where('created_at', '>=', now()->subDays(30))->count(),

            'recentUsers' => User::latest()->take(8)->get(),
            'recentEnrollments' => Enrollment::with(['user', 'course'])->latest()->take(5)->get(),
        ]);
    }

    public function manageUsers(Request $request)
    {
        $this->ensureAdmin();

        $query = User::with(['courses', 'enrollments']);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('status')) {
            $query->where('approval_status', $request->status);
        }

        return view('admin.users.index', [
            'users' => $query->latest()->paginate(10),
            'totalUsers' => User::count(),
            'roles' => ['admin', 'tutor', 'student'],
            'statuses' => ['pending', 'approved', 'banned'],
            'filters' => $request->all(),
        ]);
    }

    public function approveUser(User $user)
    {
        $this->ensureAdmin();

        $user->approval_status = User::STATUS_APPROVED;
        $user->save();

        return back()->with('success', "User {$user->name} approved successfully.");
    }

    public function banUser(User $user)
    {
        $this->ensureAdmin();

        $user->approval_status = User::STATUS_BANNED;
        $user->save();

        return back()->with('success', "User {$user->name} has been banned.");
    }

    public function showBanConfirmation(User $user)
    {
        $this->ensureAdmin();

        return view('admin.users.ban', compact('user'));
    }

    public function deleteUser(User $user)
    {
        $this->ensureAdmin();

        try {
            if ($user->profile_photo && Storage::exists($user->profile_photo)) {
                Storage::delete($user->profile_photo);
            }

            $user->delete();

            return back()->with('success', "User {$user->name} deleted successfully.");
        } catch (\Exception $e) {
            return back()->with('error', "Error deleting user: " . $e->getMessage());
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
