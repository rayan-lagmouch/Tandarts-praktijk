<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'person_id',
        'number',
        'employee_type',
        'specialization',
        'availability',
        'is_active',
        'note',
    ];

}
