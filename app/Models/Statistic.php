<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $table = 'statistics';

    protected $fillable = [
        'stat_key', 'stat_value', 'stat_label', 'stat_icon', 'is_active', 'display_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
