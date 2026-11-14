<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class KasDummyDataTest extends TestCase
{
    public function test_kas_dummy_seeder_has_realistic_and_working_structure(): void
    {
        $seederContent = file_get_contents(dirname(__DIR__, 2) . '/database/seeders/KasDummySeeder.php');
        
        // Memastikan terdapat transaksi dengan status Cicil (is_piutang: true) dan nomor WA
        $this->assertStringContainsString("'is_piutang'       => true", $seederContent);
        $this->assertStringContainsString("'is_piutang'       => false", $seederContent);
        $this->assertStringContainsString("'no_hp'", $seederContent);
        $this->assertStringContainsString('081238914520', $seederContent);
        $this->assertStringContainsString('085739182940', $seederContent);
        $this->assertStringContainsString('081999887766', $seederContent);
        $this->assertStringContainsString('087860112233', $seederContent);

        // Memastikan keterangan rich text HTML dengan styling bold dan list
        $this->assertStringContainsString('<p><strong>', $seederContent);
        $this->assertStringContainsString('<ul><li>', $seederContent);

        // Memastikan terdapat nama penanggung / siswa Bali yang realistis
        $this->assertStringContainsString('Ni Made Ayu Saraswati', $seederContent);
        $this->assertStringContainsString('I Kadek Dwi Artha Yoga', $seederContent);
        $this->assertStringContainsString('I Putu Gede Arimbawa', $seederContent);
        $this->assertStringContainsString('Ni Luh Putu Sintya Dewi', $seederContent);
        $this->assertStringContainsString('Komang Arya Wiranata', $seederContent);

        // Memastikan pelunasan cicilan didukung (piutang_lunas_at)
        $this->assertStringContainsString("'piutang_lunas_at' => '2026-11-12 11:30:00'", $seederContent);
    }

    public function test_user_seeder_contains_all_three_active_backoffice_roles(): void
    {
        $userSeeder = file_get_contents(dirname(__DIR__, 2) . '/database/seeders/UserSeeder.php');
        $this->assertStringContainsString("'role' => 'super_admin'", $userSeeder);
        $this->assertStringContainsString("'role' => 'admin'", $userSeeder);
        $this->assertStringContainsString("'role' => 'finance'", $userSeeder);
        $this->assertStringContainsString('denpasarhotelschool', $userSeeder);
        $this->assertStringContainsString('indoapps2026', $userSeeder);
    }
}
