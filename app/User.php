<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'owner_id');
    }

    public function userRoles()
    {
        return $this->belongsTo(UserRoles::class, 'role');
    }

    public function isAdmin()
    {
        return $this->userRoles->name == 'administrator';
    }

    public function isModerator()
    {
        return $this->userRoles->name == 'moderator';
    }
}
