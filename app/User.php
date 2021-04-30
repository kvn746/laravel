<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
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

    public function getAllAdministratorsEmail()
    {
        return static::where('role', UserRoles::select('id')->where('name', 'administrator')->first()->id)->get('email');
    }
}
