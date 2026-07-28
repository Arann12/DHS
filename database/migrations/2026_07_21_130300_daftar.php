<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Migrasi ini kosong karena semua tabel sudah didefinisikan di database/schema.sql
        // dan diimport manual ke database MySQL.
        // File ini dibuat hanya untuk tracking purpose di migrations table.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak ada tabel yang dibuat di up(), jadi tidak ada yang perlu di-drop
    }
};
