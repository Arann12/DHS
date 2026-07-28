<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    protected $table = 'media_files';

    protected $fillable = [
        'file_name',
        'file_path',
        'file_type',
        'mime_type',
        'file_size',
        'uploaded_by',
        'usage_context',
        'alt_text',
    ];
}
