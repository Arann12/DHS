<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KasCategory extends Model
{
    protected $table = 'kas_categories';

    protected $fillable = [
        'type',
        'nama',
        'deskripsi',
        'is_active',
        'bisa_cicil',
        'display_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'bisa_cicil' => 'boolean',
        'display_order' => 'integer',
    ];
}

