<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user can view the admin dashboard.
     */
    public function viewAdminDashboard(User $admin)
    {
        return $admin->isAdmin() && $admin->isApproved();
    }

    /**
     * Determine if the user can manage other users.
     */
    public function manageUsers(User $admin)
    {
        return $admin->isAdmin() && $admin->isApproved();
    }

    /**
     * Determine if the user can view another user's profile.
     */
    public function viewUser(User $admin, User $user)
    {
        return $admin->isAdmin() && $admin->isApproved();
    }

    /**
     * Determine if the user can approve another user.
     */
    public function approveUser(User $admin, User $user)
    {
        return $admin->isAdmin() 
            && $admin->isApproved() 
            && $user->isPending()
            && !$user->isAdmin();
    }

    /**
     * Determine if the user can ban another user.
     */
    public function banUser(User $admin, User $user)
    {
        // Admins can't ban other admins
        return $admin->isAdmin() 
            && $admin->isApproved() 
            && !$user->isAdmin();
    }

    /**
     * Determine if the user can delete another user.
     */
    public function deleteUser(User $admin, User $user)
    {
        // Admins can't delete other admins
        return $admin->isAdmin() 
            && $admin->isApproved() 
            && !$user->isAdmin();
    }

    /**
     * Determine if the user can impersonate another user.
     */
    public function impersonate(User $admin, User $user)
    {
        // Can't impersonate admins or yourself
        return $admin->isAdmin() 
            && $admin->isApproved() 
            && !$user->isAdmin()
            && $admin->id !== $user->id;
    }
}