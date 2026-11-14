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
        Schema::table('kas_categories', function (Blueprint $table) {
            if (!Schema::hasColumn('kas_categories', 'bisa_cicil')) {
                $table->boolean('bisa_cicil')->default(false)->after('is_active');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kas_categories', function (Blueprint $table) {
            if (Schema::hasColumn('kas_categories', 'bisa_cicil')) {
                $table->dropColumn('bisa_cicil');
            }
        });
    }
};
