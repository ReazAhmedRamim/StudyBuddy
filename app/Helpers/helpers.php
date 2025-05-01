<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('isApprovedUser')) {
    function isApprovedUser() {
        $user = Auth::user();
        return $user && $user->is_approved; // assuming `is_approved` column exists
    }
}

if (!function_exists('setSidebar')) {
    function setSidebar(array $patterns) {
        $currentRoute = request()->route()->getName();
        foreach ($patterns as $pattern) {
            if (\Illuminate\Support\Str::is($pattern, $currentRoute)) {
                return 'mm-active';
            }
        }
        return '';
    }
}
