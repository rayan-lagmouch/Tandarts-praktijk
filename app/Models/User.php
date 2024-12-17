<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'person_id',
        'username',
        'is_logged_in',
        'logged_in',
        'logged_out',
        'is_active',
        'note',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->email === 'admin@example.com';
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function roles()
    {
        return $this->hasMany(Role::class);
    }
}
