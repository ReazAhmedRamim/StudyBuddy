<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
        return $next($request);
        }

        return redirect('/')->with('error', 'Unauthorized access.');
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        
        if ($user->role !== \App\Models\User::ROLE_ADMIN) {
            return redirect()->route('login')->with('error', 'Unauthorized access');
        }

        if ($user->status === \App\Models\User::STATUS_BANNED) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Account banned');
        }

        return $next($request);
    }
}