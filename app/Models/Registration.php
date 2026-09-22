<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $table = 'registrations';

    protected $fillable = [
        'full_name', 'phone', 'email', 'category_key', 'program_title',
        'special_request', 'registration_fee_proof', 'program_fee_proof',
        'info_sources', 'status', 'notes', 'registration_date',
        'admin_reply', 'replied_at',
    ];

    protected $casts = [
        'info_sources'    => 'array',
        'registration_date' => 'date',
        'replied_at'      => 'datetime',
    ];

    public function admissions()
    {
        return $this->hasMany(Admission::class, 'registration_id');
    }
}
