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
        if (!Schema::hasTable('partners')) {
            Schema::create('partners', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('logo_url', 500)->nullable();
                $table->enum('type', ['hotel', 'restaurant', 'cruise', 'education', 'government', 'other'])->default('other')->index('idx_type');
                $table->string('partner_group', 50)->default('mitra_industri');
                $table->text('description')->nullable();
                $table->string('website_url', 500)->nullable();
                $table->string('country', 100)->nullable();
                $table->boolean('is_active')->default(true);
                $table->boolean('is_featured')->default(false)->index('idx_is_featured');
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
        Schema::dropIfExists('partners');
    }
};
