<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'rating',
        'practice_email',
        'practice_phone',
        'is_active',
        'note',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
