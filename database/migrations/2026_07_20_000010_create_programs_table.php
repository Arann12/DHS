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
        if (!Schema::hasTable('programs')) {
            Schema::create('programs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('category_id')->constrained('program_categories')->cascadeOnDelete();
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('country_badge', 100)->nullable();
                $table->text('description')->nullable();
                $table->string('duration', 100)->nullable();
                $table->text('requirements')->nullable();
                $table->longText('curriculum')->nullable();
                $table->text('facilities')->nullable();
                $table->string('thumbnail_url', 500)->nullable();
                $table->string('brochure_url', 500)->nullable();
                $table->decimal('tuition_fee', 15, 2)->nullable();
                $table->boolean('is_active')->default(true)->index('idx_is_active');
                $table->boolean('is_featured')->default(false)->index('idx_is_featured');
                $table->integer('display_order')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
