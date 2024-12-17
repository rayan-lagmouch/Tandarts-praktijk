<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'number',
        'employee_type',
        'specialization',
        'availability',
        'is_active',
        'note',
    ];

    /**
     * Relationship to the Person model.
     */
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    /**
     * Accessor to get the full name of the employee.
     */
    public function getFullNameAttribute()
    {
        return $this->person->first_name . ' ' . $this->person->last_name;
    }

    /**
     * Relationship to the Appointment model.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Relationship to the Availability model.
     */
    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }

    /**
     * Relationship to the Treatment model.
     */
    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }

    /**
     * Relationship to the Communication model.
     */
    public function communications()
    {
        return $this->hasMany(Communication::class);
    }
}
