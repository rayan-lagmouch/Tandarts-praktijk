<?php
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
    
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}

