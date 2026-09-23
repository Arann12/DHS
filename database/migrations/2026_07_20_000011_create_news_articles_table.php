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
        if (!Schema::hasTable('news_articles')) {
            Schema::create('news_articles', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->enum('category', [
                    'prestasi', 'akademik', 'kegiatan', 'admisi', 'alumni',
                    'umum', 'partnership', 'kampus', 'keberlanjutan'
                ])->default('umum')->index('idx_category');
                $table->text('excerpt')->nullable();
                $table->longText('content')->nullable();
                $table->string('thumbnail_url', 500)->nullable();
                $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
                $table->enum('status', ['draft', 'dipublikasikan', 'archived'])->default('draft')->index('idx_status');
                $table->dateTime('published_at')->nullable()->index('idx_published_at');
                $table->unsignedInteger('views_count')->default(0);
                $table->boolean('is_featured')->default(false)->index('idx_is_featured');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_articles');
    }
};
