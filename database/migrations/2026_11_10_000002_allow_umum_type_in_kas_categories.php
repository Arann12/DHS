<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah kolom type di kas_categories agar bisa menerima 'umum'
        DB::statement("ALTER TABLE kas_categories MODIFY COLUMN type VARCHAR(50) NOT NULL");

        // Update kategori umum yang sudah ada agar bertipe 'umum'
        $umumNames = [
            'Biaya Operasional Kantor',
            'Biaya Listrik & Air & Internet',
            'Perawatan Fasilitas & Gedung',
            'Biaya Administrasi & ATK',
            'Sewa Fasilitas Kampus',
        ];
        DB::table('kas_categories')->whereIn('nama', $umumNames)->update(['type' => 'umum']);
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE kas_categories MODIFY COLUMN type ENUM('masuk', 'keluar') NOT NULL");
    }
};
