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
        Schema::table('registrations', function (Blueprint $table) {
            $table->decimal('nominal_pembayaran', 15, 2)->nullable()->after('special_request');
            $table->string('bukti_pembayaran', 500)->nullable()->after('program_fee_proof');
            $table->unsignedBigInteger('kas_transaction_id')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['nominal_pembayaran', 'bukti_pembayaran', 'kas_transaction_id']);
        });
    }
};
