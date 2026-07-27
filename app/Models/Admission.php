<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    protected $table = 'admissions';

    protected $fillable = [
        'registration_id', 'student_name', 'student_id', 'program_id',
        'admission_year', 'admission_semester', 'status', 'graduation_date', 'notes',
    ];

    protected $casts = [
        'graduation_date' => 'date',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function registration()
    {
        return $this->belongsTo(Registration::class, 'registration_id');
    }
}
