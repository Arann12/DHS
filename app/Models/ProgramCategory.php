<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramCategory extends Model
{
    protected $table = 'program_categories';

    protected $fillable = [
        'category_key',
        'category_name',
        'subtitle',
        'description',
        'career_opportunities',
        'is_active',
        'display_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function programs()
    {
        return $this->hasMany(Program::class, 'category_id')->orderBy('display_order');
    }
}
