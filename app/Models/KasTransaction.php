<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KasTransaction extends Model
{
    protected $table = 'kas_transactions';

    protected $fillable = [
        'type',
        'jenis',
        'kode',
        'deskripsi',
        'satuan',
        'volume',
        'harga_satuan',
        'jumlah',
        'keterangan',
        'tanggal',
        'bukti_gambar',
        'created_by',
        'program_id',
        'project_id',
        'is_piutang',
        'piutang_lunas_at',
        'piutang_nama',
    ];

    protected $casts = [
        'tanggal'          => 'date',
        'volume'           => 'decimal:2',
        'harga_satuan'     => 'decimal:2',
        'jumlah'           => 'decimal:2',
        'is_piutang'       => 'boolean',
        'piutang_lunas_at' => 'datetime',
    ];

    public function program()
    {
        return $this->belongsTo(\App\Models\Program::class, 'program_id');
    }

    public function project()
    {
        return $this->belongsTo(\App\Models\KasProject::class, 'project_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
