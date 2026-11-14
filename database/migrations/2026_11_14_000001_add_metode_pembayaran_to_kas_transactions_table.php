<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kas_transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('kas_transactions', 'metode_pembayaran')) {
                $table->string('metode_pembayaran', 50)->nullable()->default('Transfer Bank')->after('no_hp');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kas_transactions', function (Blueprint $table) {
            if (Schema::hasColumn('kas_transactions', 'metode_pembayaran')) {
                $table->dropColumn('metode_pembayaran');
            }
        });
    }
};

