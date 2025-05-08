<?php

use Illuminate\Support\Facades\Auth;
// use App\Models\Category;
use App\Models\User;


if (!function_exists('isApprovedUser')) {
    function isApprovedUser() {
        $user = Auth::user();
        return $user && $user->is_approved; // assuming `is_approved` column exists
    }
}

  // Instead of Auth::user()->id

if (!function_exists('isApprovedUser')) {
    function isApprovedUser() {
        $user = Auth::user();
        logger('Approval Check:', [
            'user_id' => $user?->id,
            'is_approved' => $user?->is_approved
        ]);
        return $user && $user->is_approved;
    }
}
// sidebar active

if (!function_exists('setSidebarActive')) {
    function setSidebarActive(array $routes): ?string
    {
        foreach ($routes as $route) {
            if (request()->routeIs($route)) {
                return 'text-primary bg-primary/10 border-r-4 border-primary';
            }
        }
        return null;
    }
}