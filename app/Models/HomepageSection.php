<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageSection extends Model
{
    protected $table = 'homepage_sections';

    protected $fillable = [
        'section_key',
        'section_title',
        'section_content',
        'is_active',
        'display_order',
    ];

    protected $casts = [
        'section_content' => 'array',
        'is_active' => 'boolean',
    ];
}
