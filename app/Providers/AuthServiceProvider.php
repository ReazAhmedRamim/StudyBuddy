<?php

namespace App\Providers;

use App\Policies\UserPolicy;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication/authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        if (app()->environment('production')) {
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('route:cache');
        \Illuminate\Support\Facades\Artisan::call('config:cache');
        \Illuminate\Support\Facades\Artisan::call('view:cache');
    }

        Gate::before(function ($user, $ability) {
            if ($user->isSuperAdmin()) { // If you have a super admin role
                return true;
            }
        });

        // Define admin dashboard gate
        Gate::define('viewAdminDashboard', function (User $user) {
            return $user->isAdmin();
        });
    }
}