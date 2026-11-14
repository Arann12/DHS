<?php

namespace Tests\Unit;

use App\Http\Middleware\BackofficeAuth;
use PHPUnit\Framework\TestCase;

class BackofficeAuthTest extends TestCase
{
    public function test_admin_cannot_access_finance_routes(): void
    {
        $this->assertFalse(BackofficeAuth::roleAllowsPath('admin', 'backoffice/kas'));
    }

    public function test_finance_can_access_finance_routes_but_not_cms_routes(): void
    {
        $this->assertTrue(BackofficeAuth::roleAllowsPath('finance', 'backoffice/kas'));
        $this->assertTrue(BackofficeAuth::roleAllowsPath('finance', 'backoffice/program-kategori'));
        $this->assertFalse(BackofficeAuth::roleAllowsPath('finance', 'backoffice/berita'));
        $this->assertFalse(BackofficeAuth::roleAllowsPath('finance', 'backoffice/dashboard'));
    }

    public function test_super_admin_can_access_all_backoffice_routes(): void
    {
        $this->assertTrue(BackofficeAuth::roleAllowsPath('super_admin', 'backoffice/kas'));
        $this->assertTrue(BackofficeAuth::roleAllowsPath('super_admin', 'backoffice/berita'));
    }

    public function test_only_super_admin_can_access_users_management(): void
    {
        $this->assertTrue(BackofficeAuth::roleAllowsPath('super_admin', 'backoffice/users'));
        $this->assertTrue(BackofficeAuth::roleAllowsPath('super_admin', 'backoffice/users/store'));
        $this->assertTrue(BackofficeAuth::roleAllowsPath('super_admin', 'backoffice/users/1/update'));
        $this->assertTrue(BackofficeAuth::roleAllowsPath('super_admin', 'backoffice/users/1/delete'));

        $this->assertFalse(BackofficeAuth::roleAllowsPath('admin', 'backoffice/users'));
        $this->assertFalse(BackofficeAuth::roleAllowsPath('admin', 'backoffice/users/store'));
        $this->assertFalse(BackofficeAuth::roleAllowsPath('admin', 'backoffice/users/1/update'));
        $this->assertFalse(BackofficeAuth::roleAllowsPath('admin', 'backoffice/users/1/delete'));

        $this->assertFalse(BackofficeAuth::roleAllowsPath('finance', 'backoffice/users'));
        $this->assertFalse(BackofficeAuth::roleAllowsPath('finance', 'backoffice/users/store'));
    }
}
