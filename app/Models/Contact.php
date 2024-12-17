<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'street_name',
        'house_number',
        'addition',
        'postal_code',
        'city',
        'mobile',
        'email',
        'is_active',
        'note',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
