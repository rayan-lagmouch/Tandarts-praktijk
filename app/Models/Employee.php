<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'person_id',
        'employee_type',
        'specialization',
        'availability',
        'is_active',
        'note',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function getFullNameAttribute()
    {
        return $this->person->first_name . ' ' . $this->person->last_name;
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
