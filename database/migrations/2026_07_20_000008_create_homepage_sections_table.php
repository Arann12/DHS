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
        if (!Schema::hasTable('homepage_sections')) {
            Schema::create('homepage_sections', function (Blueprint $table) {
                $table->id();
                $table->string('section_key', 100)->unique();
                $table->string('section_title')->nullable();
                $table->json('section_content')->nullable();
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
        Schema::dropIfExists('homepage_sections');
    }
};
