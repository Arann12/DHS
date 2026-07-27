<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faqs';

    protected $fillable = [
        'question', 'answer', 'category', 'is_active', 'display_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
