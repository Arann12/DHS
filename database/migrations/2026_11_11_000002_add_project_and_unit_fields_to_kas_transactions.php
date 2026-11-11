<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kas_transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('kas_transactions', 'project_id')) {
                $table->unsignedBigInteger('project_id')->nullable()->after('program_id');
            }
            if (!Schema::hasColumn('kas_transactions', 'satuan')) {
                $table->string('satuan', 50)->nullable()->after('deskripsi');
            }
            if (!Schema::hasColumn('kas_transactions', 'volume')) {
                $table->decimal('volume', 10, 2)->default(1)->after('satuan');
            }
            if (!Schema::hasColumn('kas_transactions', 'harga_satuan')) {
                $table->decimal('harga_satuan', 15, 2)->nullable()->after('volume');
            }
            if (!Schema::hasColumn('kas_transactions', 'keterangan')) {
                $table->text('keterangan')->nullable()->after('jumlah');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kas_transactions', function (Blueprint $table) {
            $cols = array_filter(
                ['project_id', 'satuan', 'volume', 'harga_satuan', 'keterangan'],
                fn($c) => Schema::hasColumn('kas_transactions', $c)
            );
            if (!empty($cols)) {
                $table->dropColumn(array_values($cols));
            }
        });
    }
};

