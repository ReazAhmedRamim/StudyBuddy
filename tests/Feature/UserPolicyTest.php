<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserPolicyTest extends TestCase
{
    use RefreshDatabase;

    // Approval Tests
    public function test_admin_can_approve_pending_users()
    {
        $admin = User::factory()->admin()->approved()->create();
        $tutor = User::factory()->tutor()->pending()->create();
        $student = User::factory()->student()->pending()->create();
        
        $this->assertTrue($admin->can('approveUser', $tutor));
        $this->assertTrue($admin->can('approveUser', $student));
    }

    public function test_admin_cannot_approve_already_approved_users()
    {
        $admin = User::factory()->admin()->approved()->create();
        $approvedTutor = User::factory()->tutor()->approved()->create();
        
        $this->assertFalse($admin->can('approveUser', $approvedTutor));
    }

    public function test_admin_cannot_approve_other_admins()
    {
        $admin = User::factory()->admin()->approved()->create();
        $pendingAdmin = User::factory()->admin()->pending()->create();
        
        $this->assertFalse($admin->can('approveUser', $pendingAdmin));
    }

    public function test_non_admin_cannot_approve_users()
    {
        $regularUser = User::factory()->student()->approved()->create();
        $pendingTutor = User::factory()->tutor()->pending()->create();
        
        $this->assertFalse($regularUser->can('approveUser', $pendingTutor));
    }

    // Ban Tests
    public function test_admin_can_ban_non_admin_users()
    {
        $admin = User::factory()->admin()->approved()->create();
        $tutor = User::factory()->tutor()->approved()->create();
        $student = User::factory()->student()->approved()->create();
        
        $this->assertTrue($admin->can('banUser', $tutor));
        $this->assertTrue($admin->can('banUser', $student));
    }

    public function test_admin_cannot_ban_other_admins()
    {
        $admin = User::factory()->admin()->approved()->create();
        $otherAdmin = User::factory()->admin()->approved()->create();
        
        $this->assertFalse($admin->can('banUser', $otherAdmin));
    }

    public function test_admin_can_unban_banned_users()
    {
        $admin = User::factory()->admin()->approved()->create();
        $bannedTutor = User::factory()->tutor()->banned()->create();
        
        $this->assertTrue($admin->can('banUser', $bannedTutor));
    }

    // Dashboard Access Tests
    public function test_approved_admin_can_view_dashboard()
    {
        $admin = User::factory()->admin()->approved()->create();
        $this->assertTrue($admin->can('viewAdminDashboard'));
    }

    public function test_pending_admin_cannot_view_dashboard()
    {
        $pendingAdmin = User::factory()->admin()->pending()->create();
        $this->assertFalse($pendingAdmin->can('viewAdminDashboard'));
    }

    public function test_non_admin_cannot_view_dashboard()
    {
        $tutor = User::factory()->tutor()->approved()->create();
        $student = User::factory()->student()->approved()->create();
        
        $this->assertFalse($tutor->can('viewAdminDashboard'));
        $this->assertFalse($student->can('viewAdminDashboard'));
    }

    // User Management Tests
    public function test_admin_can_manage_users()
    {
        $admin = User::factory()->admin()->approved()->create();
        $this->assertTrue($admin->can('manageUsers'));
    }

    public function test_admin_can_view_user_profiles()
    {
        $admin = User::factory()->admin()->approved()->create();
        $tutor = User::factory()->tutor()->approved()->create();
        
        $this->assertTrue($admin->can('viewUser', $tutor));
    }

    // Delete Tests
    public function test_admin_can_delete_non_admin_users()
    {
        $admin = User::factory()->admin()->approved()->create();
        $tutor = User::factory()->tutor()->approved()->create();
        
        $this->assertTrue($admin->can('deleteUser', $tutor));
    }

    public function test_admin_cannot_delete_other_admins()
    {
        $admin = User::factory()->admin()->approved()->create();
        $otherAdmin = User::factory()->admin()->approved()->create();
        
        $this->assertFalse($admin->can('deleteUser', $otherAdmin));
    }

    // Impersonation Tests
    public function test_admin_can_impersonate_non_admin_users()
    {
        $admin = User::factory()->admin()->approved()->create();
        $tutor = User::factory()->tutor()->approved()->create();
        
        $this->assertTrue($admin->can('impersonate', $tutor));
    }

    public function test_admin_cannot_impersonate_other_admins()
    {
        $admin = User::factory()->admin()->approved()->create();
        $otherAdmin = User::factory()->admin()->approved()->create();
        
        $this->assertFalse($admin->can('impersonate', $otherAdmin));
    }

    public function test_admin_cannot_impersonate_themselves()
    {
        $admin = User::factory()->admin()->approved()->create();
        $this->assertFalse($admin->can('impersonate', $admin));
    }

    public function test_banned_admin_has_no_permissions()
    {
        $bannedAdmin = User::factory()->admin()->banned()->create();
        $tutor = User::factory()->tutor()->approved()->create();
        
        $this->assertFalse($bannedAdmin->can('viewAdminDashboard'));
        $this->assertFalse($bannedAdmin->can('approveUser', $tutor));
        $this->assertFalse($bannedAdmin->can('banUser', $tutor));
        $this->assertFalse($bannedAdmin->can('deleteUser', $tutor));
    }
}