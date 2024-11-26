<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'person_id',
        'number',
        'medical_record',
        'is_active',
        'note',
    ];

}
