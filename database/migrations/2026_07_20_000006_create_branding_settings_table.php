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
        if (!Schema::hasTable('branding_settings')) {
            Schema::create('branding_settings', function (Blueprint $table) {
                $table->id();
                $table->string('setting_key', 100)->unique();
                $table->text('setting_value')->nullable();
                $table->enum('setting_type', ['text', 'color', 'file', 'json'])->default('text');
                $table->string('setting_group', 50)->default('general')->index('idx_setting_group');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branding_settings');
    }
};
