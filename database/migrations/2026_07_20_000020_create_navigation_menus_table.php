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
        if (!Schema::hasTable('navigation_menus')) {
            Schema::create('navigation_menus', function (Blueprint $table) {
                $table->id();
                $table->foreignId('parent_id')->nullable()->constrained('navigation_menus')->cascadeOnDelete();
                $table->string('menu_label');
                $table->string('menu_url', 500)->nullable();
                $table->enum('menu_type', ['header', 'footer', 'both'])->default('header')->index('idx_menu_type');
                $table->boolean('target_blank')->default(false);
                $table->string('icon_class', 100)->nullable();
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
        Schema::dropIfExists('navigation_menus');
    }
};
