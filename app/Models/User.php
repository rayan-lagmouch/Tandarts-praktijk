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

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        // Check if the email ends with @admin.com
        return str_ends_with($this->email, '@admin.com');
    }

    /**
     * Check if the user is an employee.
     *
     * @return bool
     */
    public function isEmployee(): bool
    {
        // Check if the email ends with @smilepro.com
        return str_ends_with($this->email, '@smilepro.com');
    }

    /**
     * Get the person associated with the user.
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Get the roles associated with the user.
     */
    public function roles()
    {
        return $this->hasMany(Role::class);
    }
}
