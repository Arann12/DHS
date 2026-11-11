<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $table = 'registrations';

    protected $fillable = [
        'full_name', 'phone', 'email', 'category_key', 'program_title',
        'special_request', 'payment_mode', 'total_biaya', 'nominal_pembayaran', 'sisa_tagihan',
        'registration_fee_proof', 'program_fee_proof',
        'bukti_pembayaran', 'info_sources', 'status', 'kas_transaction_id', 'piutang_kas_id',
        'notes', 'registration_date', 'admin_reply', 'replied_at',
    ];

    protected $casts = [
        'info_sources'       => 'array',
        'registration_date'  => 'date',
        'replied_at'         => 'datetime',
        'total_biaya'        => 'decimal:2',
        'nominal_pembayaran' => 'decimal:2',
        'sisa_tagihan'       => 'decimal:2',
    ];

    public function kasTransaction()
    {
        return $this->belongsTo(KasTransaction::class, 'kas_transaction_id');
    }

    public function piutangKas()
    {
        return $this->belongsTo(KasTransaction::class, 'piutang_kas_id');
    }

    public function getPaymentSummary(): array
    {
        $nominal = $this->nominal_pembayaran ? (float) $this->nominal_pembayaran : null;
        $total   = $this->total_biaya ? (float) $this->total_biaya : null;
        $mode    = $this->payment_mode ?: ($nominal > 0 ? 'lunas' : 'belum');

        $piutangTrx = $this->relationLoaded('piutangKas')
            ? $this->piutangKas
            : ($this->piutang_kas_id ? $this->piutangKas()->first() : null);

        $liveSisa      = 0.0;
        $isPiutangOpen = false;
        if ($mode === 'dp') {
            if ($piutangTrx) {
                $isPiutangOpen = (bool) ($piutangTrx->is_piutang && !$piutangTrx->piutang_lunas_at);
                $liveSisa      = $isPiutangOpen ? (float) $piutangTrx->jumlah : 0.0;
            } else {
                $liveSisa      = $this->sisa_tagihan ? (float) $this->sisa_tagihan : 0.0;
                $isPiutangOpen = $liveSisa > 0;
            }
        }

        $totalEffective = $total ?? ($nominal ?? 0.0);
        $paidTotal      = $mode === 'dp'
            ? max((float) ($nominal ?? 0), round($totalEffective - $liveSisa, 2))
            : (float) ($nominal ?? 0);

        return [
            'payment_mode'          => $mode,
            'total_biaya'           => $total,
            'total_biaya_formatted' => $total ? 'Rp ' . number_format($total, 0, ',', '.') : '-',
            'nominal_pembayaran'    => $nominal,
            'nominal_formatted'     => $nominal ? 'Rp ' . number_format($nominal, 0, ',', '.') : '-',
            'paid_total'            => $paidTotal,
            'paid_total_formatted'  => $paidTotal > 0 ? 'Rp ' . number_format($paidTotal, 0, ',', '.') : '-',
            'sisa_tagihan'          => $liveSisa,
            'sisa_formatted'        => $liveSisa > 0 ? 'Rp ' . number_format($liveSisa, 0, ',', '.') : 'Rp 0',
            'is_dp_pending'         => $mode === 'dp' && $isPiutangOpen && $liveSisa > 0,
            'is_dp_lunas'           => $mode === 'dp' && (!$isPiutangOpen || $liveSisa <= 0),
        ];
    }

    public function admissions()
    {
        return $this->hasMany(Admission::class, 'registration_id');
    }
}
