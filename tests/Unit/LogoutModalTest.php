<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class LogoutModalTest extends TestCase
{
    public function test_logout_confirmation_uses_in_page_modal_not_browser_confirm(): void
    {
        $root = dirname(__DIR__, 2);
        $topbar = file_get_contents($root . '/resources/views/backoffice/partials/topbar.blade.php');

        $this->assertStringNotContainsString("confirm('Yakin ingin logout?')", $topbar);
        $this->assertStringContainsString('openLogoutModal()', $topbar);
        $this->assertStringContainsString('logout-confirm-modal', file_get_contents($root . '/resources/views/backoffice/layouts/app.blade.php'));
    }
}
