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
        if (!Schema::hasTable('admissions')) {
            Schema::create('admissions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('registration_id')->nullable()->constrained('registrations')->nullOnDelete();
                $table->string('student_name');
                $table->string('student_id', 50)->nullable()->unique();
                $table->foreignId('program_id')->nullable()->constrained('programs')->nullOnDelete();
                $table->year('admission_year')->index('idx_admission_year');
                $table->enum('admission_semester', ['ganjil', 'genap'])->default('ganjil');
                $table->enum('status', ['active', 'graduated', 'dropout', 'transferred', 'suspended'])->default('active')->index('idx_status');
                $table->date('graduation_date')->nullable();
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};
