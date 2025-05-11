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
    /**
     * Ensure the logged-in user is an admin.
     */
    private function ensureAdmin()
    {
        if (!Auth::check() || auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }
    }

    /**
     * Show admin dashboard with metrics.
     */
    public function dashboard()
    {
        $this->ensureAdmin();

        return view('admin.dashboard.index', [
            'tutors' => User::withCount('courses')->where('role', 'tutor')->where('status', 'approved')->get(),
            'students' => User::withCount('enrollments')->where('role', 'student')->where('status', 'approved')->get(),
            'pendingTutors' => User::where('role', 'tutor')->where('status', 'pending')->count(),
            'pendingStudents' => User::where('role', 'student')->where('status', 'pending')->count(),
            'bannedUsers' => User::where('status', 'banned')->get(),
            'bannedTutors' => User::where('role', 'tutor')->where('status', 'banned')->count(),
            'bannedStudents' => User::where('role', 'student')->where('status', 'banned')->count(),
            'activeCourses' => Course::where('status', 'active')->count(),
            'newCoursesThisMonth' => Course::where('created_at', '>=', now()->subDays(30))->count(),
            'recentUsers' => User::latest()->take(8)->get(),
            'recentEnrollments' => Enrollment::with(['user', 'course'])->latest()->take(5)->get(),
        ]);
    }

    /**
     * View and filter users (tutors/students).
     */
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
            $query->where('status', $request->status);
        }

        return view('admin.users.index', [
            'users' => $query->latest()->paginate(10),
            'totalUsers' => User::count(),
            'roles' => ['admin', 'tutor', 'student'],
            'statuses' => ['pending', 'approved', 'banned'],
            'filters' => $request->all(),
        ]);
    }

    /**
     * Approve a user (tutor or student).
     */
    public function approveUser(User $user)
    {
        $this->ensureAdmin();

        $user->update(['status' => 'approved']);

        return redirect()->route('admin.dashboard')->with('success', "User {$user->name} approved successfully.");
    }

    /**
     * Show confirmation page for banning.
     */
    public function showBanConfirmation(User $user)
    {
        $this->ensureAdmin();

        return view('admin.users.ban', compact('user'));
    }

    /**
     * Ban or unban a user.
     */
    public function banUser(User $user)
    {
        $this->ensureAdmin();

        $newStatus = $user->status === 'banned' ? 'approved' : 'banned';
        $user->update(['status' => $newStatus]);

        $action = $newStatus === 'banned' ? 'banned' : 'unbanned';

        return back()->with('success', "User {$user->name} has been {$action}.");
    }

    /**
     * Delete a user and their profile photo if exists.
     */
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

    /**
     * Admin logout handler.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
