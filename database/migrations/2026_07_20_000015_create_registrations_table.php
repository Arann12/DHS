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
        if (!Schema::hasTable('registrations')) {
            Schema::create('registrations', function (Blueprint $table) {
                $table->id();
                $table->string('full_name');
                $table->string('phone', 20)->index('idx_phone');
                $table->string('email')->index('idx_email');
                $table->string('category_key', 100)->nullable();
                $table->string('program_title')->nullable();
                $table->text('special_request')->nullable();
                $table->string('registration_fee_proof', 500)->nullable();
                $table->string('program_fee_proof', 500)->nullable();
                $table->json('info_sources')->nullable();
                $table->enum('status', ['pending', 'verified', 'accepted', 'rejected', 'cancelled'])->default('pending')->index('idx_status');
                $table->text('notes')->nullable();
                $table->date('registration_date')->index('idx_registration_date');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
