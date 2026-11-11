<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            if (!Schema::hasColumn('registrations', 'payment_mode')) {
                $table->string('payment_mode', 20)->default('lunas')->after('special_request');
            }
            if (!Schema::hasColumn('registrations', 'total_biaya')) {
                $table->decimal('total_biaya', 15, 2)->nullable()->after('payment_mode');
            }
            if (!Schema::hasColumn('registrations', 'sisa_tagihan')) {
                $table->decimal('sisa_tagihan', 15, 2)->nullable()->after('nominal_pembayaran');
            }
            if (!Schema::hasColumn('registrations', 'piutang_kas_id')) {
                $table->unsignedBigInteger('piutang_kas_id')->nullable()->after('kas_transaction_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $cols = array_filter([
                Schema::hasColumn('registrations', 'payment_mode') ? 'payment_mode' : null,
                Schema::hasColumn('registrations', 'total_biaya') ? 'total_biaya' : null,
                Schema::hasColumn('registrations', 'sisa_tagihan') ? 'sisa_tagihan' : null,
                Schema::hasColumn('registrations', 'piutang_kas_id') ? 'piutang_kas_id' : null,
            ]);
            if (!empty($cols)) {
                $table->dropColumn($cols);
            }
        });
    }
};

