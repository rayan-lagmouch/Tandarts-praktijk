<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'is_active',
        'note',
    ];

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
