<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            if (!Schema::hasColumn('registrations', 'admin_reply')) {
                $table->text('admin_reply')->nullable()->after('notes')->comment('Jawaban/balasan admin ke pemohon');
            }
            if (!Schema::hasColumn('registrations', 'replied_at')) {
                $table->timestamp('replied_at')->nullable()->after('admin_reply')->comment('Waktu admin memberikan jawaban');
            }
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['admin_reply', 'replied_at']);
        });
    }
};
