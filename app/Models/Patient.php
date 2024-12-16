<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'number',
        'medical_record',
        'is_active',
        'note',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
