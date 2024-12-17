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

    /**
     * Relationship to the Person model.
     */
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    /**
     * Accessor to get the full name of the patient.
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
     * Relationship to the Contact model.
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * Relationship to the Treatment model.
     */
    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }

    /**
     * Relationship to the Invoice model.
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Relationship to the Communication model.
     */
    public function communications()
    {
        return $this->hasMany(Communication::class);
    }

    /**
     * Relationship to the Feedback model.
     */
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
