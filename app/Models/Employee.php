<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // De vulbare velden voor mass assignment
    protected $fillable = [
        'person_id',
        'number',
        'employee_type',
        'specialization',
        'availability',
        'is_active',
        'note',
    ];

    // Relatie naar het Person model
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    // Accessor om de volledige naam van de werknemer te krijgen
    public function getFullNameAttribute()
    {
        return $this->person->first_name . ' ' . $this->person->last_name;
    }

    // Relatie naar de Appointment model (afspraken van de werknemer)
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    // Relatie naar de Availability model (beschikbaarheid van de werknemer)
    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }

    // Relatie naar de Treatment model (behandelingen door de werknemer)
    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }

    // Relatie naar de Communication model (communicatie van de werknemer)
    public function communications()
    {
        return $this->hasMany(Communication::class);
    }

    // Scope om actieve werknemers te filteren
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope om werknemers op basis van type te filteren (bijv. full-time, part-time)
    public function scopeByType($query, $type)
    {
        return $query->where('employee_type', $type);
    }

    // Een methode die bepaalt of de werknemer actief is
    public function isActive(): bool
    {
        return $this->is_active;
    }

    // Methode om een korte beschrijving van de werknemer te krijgen
    public function getDescriptionAttribute()
    {
        return $this->specialization . ' - ' . $this->employee_type;
    }
}
