<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KasProject extends Model
{
    protected $table = 'kas_projects';

    protected $fillable = [
        'kode_proyek',
        'program_id',
        'judul_program',
        'nama_proyek',
        'pic',
        'tanggal_mulai',
        'tanggal_selesai',
        'nilai_proyek',
        'keterangan',
        'created_by',
    ];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
        'nilai_proyek'    => 'decimal:2',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function transactions()
    {
        return $this->hasMany(KasTransaction::class, 'project_id')
            ->orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getDisplayProgramTitleAttribute(): string
    {
        if (!empty($this->judul_program)) {
            return $this->judul_program;
        }
        if ($this->program) {
            return $this->program->title;
        }
        return 'Proyek DHS';
    }

    public function computeFinancialSummary(): array
    {
        $trx = $this->relationLoaded('transactions')
            ? $this->transactions
            : $this->transactions()->get();

        $masukCol = $trx->where('type', 'masuk')
            ->filter(fn($t) => !$t->is_piutang || $t->piutang_lunas_at);
        $keluarCol = $trx->where('type', 'keluar');

        $totalMasuk  = (float) $masukCol->sum('jumlah');
        $totalKeluar = (float) $keluarCol->sum('jumlah');
        $nilaiProyek = (float) ($this->nilai_proyek ?? 0);

        $sisaTagihan = max(0, $nilaiProyek - $totalMasuk);
        $labaBersih  = $totalMasuk - $totalKeluar;

        $persenBayar = $nilaiProyek > 0 ? min(100, round(($totalMasuk / $nilaiProyek) * 100, 1)) : 0;
        $persenSisa  = $nilaiProyek > 0 ? max(0, round(($sisaTagihan / $nilaiProyek) * 100, 1)) : 0;
        $persenBiaya = $nilaiProyek > 0 ? round(($totalKeluar / $nilaiProyek) * 100, 1) : 0;
        $marginLaba  = $totalMasuk > 0 ? round(($labaBersih / $totalMasuk) * 100, 1) : 0;

        $isLunas = $nilaiProyek > 0
            ? ($totalMasuk >= $nilaiProyek)
            : ($trx->filter(fn($t) => $t->is_piutang && !$t->piutang_lunas_at)->count() === 0);

        return [
            'nilai_proyek'  => $nilaiProyek,
            'total_masuk'   => $totalMasuk,
            'total_keluar'  => $totalKeluar,
            'sisa_tagihan'  => $sisaTagihan,
            'laba_bersih'   => $labaBersih,
            'persen_bayar'  => $persenBayar,
            'persen_sisa'   => $persenSisa,
            'persen_biaya'  => $persenBiaya,
            'margin_laba'   => $marginLaba,
            'count_masuk'   => $masukCol->count(),
            'count_keluar'  => $keluarCol->count(),
            'is_lunas'      => $isLunas,
            'is_piutang'    => ($nilaiProyek > 0 && $sisaTagihan > 0),
        ];
    }
}

