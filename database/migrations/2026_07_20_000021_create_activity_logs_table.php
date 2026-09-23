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
        if (!Schema::hasTable('activity_logs')) {
            Schema::create('activity_logs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
                $table->string('action')->index('idx_action')->comment('create, update, delete, login, logout');
                $table->string('table_name', 100)->nullable()->index('idx_table_name');
                $table->unsignedBigInteger('record_id')->nullable();
                $table->json('old_data')->nullable();
                $table->json('new_data')->nullable();
                $table->string('ip_address', 50)->nullable();
                $table->text('user_agent')->nullable();
                $table->dateTime('created_at')->useCurrent()->index('idx_created_at');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
