<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'employee_id',
        'date',
        'time',
        'status',
        'is_active',
        'note',
    ];

    /**
     * Relationship to the Patient model.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Relationship to the Employee model.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Accessor to format the appointment date and time.
     */
    public function getFormattedDateTimeAttribute()
    {
        return $this->date->format('Y-m-d') . ' at ' . $this->time->format('H:i');
    }

    /**
     * Scope to filter confirmed appointments.
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'Confirmed');
    }

    /**
     * Scope to filter canceled appointments.
     */
    public function scopeCanceled($query)
    {
        return $query->where('status', 'Canceled');
    }
}
