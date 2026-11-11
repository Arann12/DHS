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
        'display_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];
}

