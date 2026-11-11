<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('kas_projects')) {
            Schema::create('kas_projects', function (Blueprint $table) {
                $table->id();
                $table->string('kode_proyek', 50)->nullable();
                $table->unsignedBigInteger('program_id')->nullable();
                $table->string('judul_program', 150)->nullable();
                $table->string('nama_proyek', 200);
                $table->string('pic', 150);
                $table->date('tanggal_mulai')->nullable();
                $table->date('tanggal_selesai')->nullable();
                $table->decimal('nilai_proyek', 15, 2)->default(0);
                $table->text('keterangan')->nullable();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('kas_units')) {
            Schema::create('kas_units', function (Blueprint $table) {
                $table->id();
                $table->string('nama', 50)->unique();
                $table->timestamps();
            });

            $now = now();
            $defaults = ['Orang', 'Unit', 'Hari', 'Paket', 'Jam', 'Bulan', 'Pcs', 'Sesi', 'Semester', 'Lot', 'Set'];
            foreach ($defaults as $unit) {
                DB::table('kas_units')->insert([
                    'nama'       => $unit,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('kas_units');
        Schema::dropIfExists('kas_projects');
    }
};

