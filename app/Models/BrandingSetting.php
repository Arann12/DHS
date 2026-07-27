<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandingSetting extends Model
{
    protected $table = 'branding_settings';

    protected $fillable = [
        'setting_key',
        'setting_value',
        'setting_type',
        'setting_group',
    ];
}
