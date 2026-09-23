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
        if (!Schema::hasTable('testimonials')) {
            Schema::create('testimonials', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('position')->nullable();
                $table->string('company')->nullable();
                $table->text('quote');
                $table->string('photo_url', 500)->nullable();
                $table->unsignedTinyInteger('rating')->default(5);
                $table->boolean('is_featured')->default(false)->index('idx_is_featured');
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
        Schema::dropIfExists('testimonials');
    }
};
