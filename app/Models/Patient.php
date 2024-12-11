<?php
// app/Models/Patient.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'person_id',
        'medical_record',
        'is_active',
        'note',
    ];

    // Relationship with the Person model
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

