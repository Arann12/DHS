<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kas_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('program_id')->nullable()->after('created_by');
            $table->boolean('is_piutang')->default(false)->after('program_id');
            $table->timestamp('piutang_lunas_at')->nullable()->after('is_piutang');
            $table->string('piutang_nama', 150)->nullable()->after('piutang_lunas_at');
        });
    }

    public function down(): void
    {
        Schema::table('kas_transactions', function (Blueprint $table) {
            $table->dropColumn(['program_id', 'is_piutang', 'piutang_lunas_at', 'piutang_nama']);
        });
    }
};
