<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

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
}

