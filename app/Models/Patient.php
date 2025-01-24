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
     * Accessor to get the email of the patient.
     */
    public function getEmailAttribute()
    {
        return $this->person->email; // Assuming email is stored in `people` table
    }
}
