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
        if (!Schema::hasTable('media_files')) {
            Schema::create('media_files', function (Blueprint $table) {
                $table->id();
                $table->string('file_name');
                $table->string('file_path', 500);
                $table->string('file_type', 50)->index('idx_file_type')->comment('image, document, video, audio');
                $table->string('mime_type', 100)->nullable();
                $table->unsignedInteger('file_size')->nullable()->comment('Ukuran file dalam bytes');
                $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
                $table->string('usage_context', 100)->nullable()->index('idx_usage_context')->comment('Digunakan di: news, gallery, branding, program');
                $table->string('alt_text')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_files');
    }
};
