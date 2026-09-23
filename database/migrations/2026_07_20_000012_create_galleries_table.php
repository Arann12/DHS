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
        if (!Schema::hasTable('galleries')) {
            Schema::create('galleries', function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->string('image_url', 500);
                $table->string('alt_text')->nullable();
                $table->enum('category', ['kampus', 'kegiatan', 'fasilitas', 'alumnus', 'partnership', 'umum'])->default('umum')->index('idx_category');
                $table->integer('display_order')->default(0)->index('idx_display_order');
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
