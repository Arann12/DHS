<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'programs';

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'country_badge',
        'description',
        'duration',
        'requirements',
        'curriculum',
        'facilities',
        'thumbnail_url',
        'brochure_url',
        'tuition_fee',
        'is_active',
        'is_featured',
        'display_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'tuition_fee' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(ProgramCategory::class, 'category_id');
    }
}
