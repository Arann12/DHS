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
        if (!Schema::hasTable('statistics')) {
            Schema::create('statistics', function (Blueprint $table) {
                $table->id();
                $table->string('stat_key', 100)->unique();
                $table->string('stat_value');
                $table->string('stat_label')->nullable();
                $table->string('stat_icon', 100)->nullable();
                $table->boolean('is_active')->default(true);
                $table->integer('display_order')->default(0)->index('idx_display_order');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
