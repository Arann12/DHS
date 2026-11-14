<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kas_transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('kas_transactions', 'no_hp')) {
                $table->string('no_hp', 50)->nullable()->after('piutang_nama');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kas_transactions', function (Blueprint $table) {
            if (Schema::hasColumn('kas_transactions', 'no_hp')) {
                $table->dropColumn('no_hp');
            }
        });
    }
};

