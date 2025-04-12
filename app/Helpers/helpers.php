<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('isApprovedUser')) {
    function isApprovedUser() {
        $user = Auth::user();
        return $user && $user->is_approved; // assuming `is_approved` column exists
    }
}
