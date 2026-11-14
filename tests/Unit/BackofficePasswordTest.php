<?php

namespace Tests\Unit;

use App\Http\Controllers\BackofficeController;
use PHPUnit\Framework\TestCase;

class BackofficePasswordTest extends TestCase
{
    public function test_password_update_rejects_a_wrong_current_password(): void
    {
        $this->assertFalse(BackofficeController::passwordMatches('wrong', password_hash('correct', PASSWORD_BCRYPT)));
    }
}
