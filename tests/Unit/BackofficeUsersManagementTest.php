<?php

namespace Tests\Unit;

use App\Http\Middleware\BackofficeAuth;
use PHPUnit\Framework\TestCase;

class BackofficeUsersManagementTest extends TestCase
{
    public function test_only_super_admin_can_access_all_user_endpoints(): void
    {
        $endpoints = [
            'backoffice/users',
            'backoffice/users/store',
            'backoffice/users/1/update',
            'backoffice/users/1/delete',
        ];

        foreach ($endpoints as $ep) {
            $this->assertTrue(BackofficeAuth::roleAllowsPath('super_admin', $ep), "super_admin must be allowed for {$ep}");
            $this->assertFalse(BackofficeAuth::roleAllowsPath('admin', $ep), "admin must NOT be allowed for {$ep}");
            $this->assertFalse(BackofficeAuth::roleAllowsPath('finance', $ep), "finance must NOT be allowed for {$ep}");
        }
    }

    public function test_sidebar_displays_kelola_akun_exclusively_for_super_admin(): void
    {
        $sidebarContent = file_get_contents(dirname(__DIR__, 2) . '/resources/views/backoffice/partials/sidebar.blade.php');

        $this->assertStringContainsString('/backoffice/users', $sidebarContent);
        $this->assertStringContainsString('Kelola Akun', $sidebarContent);
        $this->assertStringContainsString("currentRole === 'super_admin'", $sidebarContent);
    }

    public function test_users_blade_contains_account_creation_form_and_role_selection(): void
    {
        $viewContent = file_get_contents(dirname(__DIR__, 2) . '/resources/views/backoffice/users.blade.php');

        // Header & stats
        $this->assertStringContainsString('Kelola Akun Backoffice', $viewContent);
        $this->assertStringContainsString('Buat Akun Baru', $viewContent);
        $this->assertStringContainsString('Super Admin', $viewContent);
        $this->assertStringContainsString('Admin CMS', $viewContent);
        $this->assertStringContainsString('Finance', $viewContent);

        // Form fields
        $this->assertStringContainsString('modal.form.nama', $viewContent);
        $this->assertStringContainsString('modal.form.username', $viewContent);
        $this->assertStringContainsString('modal.form.email', $viewContent);
        $this->assertStringContainsString('modal.form.role', $viewContent);
        $this->assertStringContainsString('modal.form.password', $viewContent);
        $this->assertStringContainsString('modal.form.password_confirmation', $viewContent);
        $this->assertStringContainsString('modal.form.aktif', $viewContent);

        // Security indicators
        $this->assertStringContainsString('isSelf', $viewContent);
        $this->assertStringContainsString('Akun Anda', $viewContent);
    }
}
