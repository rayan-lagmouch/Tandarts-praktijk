<?php
// app/Models/Person.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        // other fields
    ];

    // Cast date_of_birth to Carbon instance
    protected $casts = [
        'date_of_birth' => 'datetime',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}

