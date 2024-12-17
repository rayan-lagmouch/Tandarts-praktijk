<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'from_date',
        'to_date',
        'from_time',
        'to_time',
        'status',
        'is_active',
        'note',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
