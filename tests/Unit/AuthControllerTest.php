<?php

namespace Tests\Unit;

use App\Http\Controllers\AuthController;
use PHPUnit\Framework\TestCase;

class AuthControllerTest extends TestCase
{
    public function test_missing_user_fallback_uses_a_valid_bcrypt_hash(): void
    {
        $info = password_get_info(AuthController::DUMMY_PASSWORD_HASH);

        $this->assertSame('bcrypt', $info['algoName']);
        $this->assertFalse(password_verify('not-the-password', AuthController::DUMMY_PASSWORD_HASH));
    }
}
