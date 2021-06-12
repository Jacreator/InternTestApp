<?php

namespace App;

use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes,HasApiTokens;

        // user verification status
    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';
    // soft delete  
    protected $date = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'verification_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // setters for name
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtolower($name);
    }

    // getter for name
    public function getNameAttribute($name)
    {
        return ucwords($name);
    }

    // setters for email
    public function setEmailAttribute($email)
    {
        $this->attributes['email'] = strtolower($email);
    }

    // getter for name
    public function getEmailAttribute($email)
    {
        return ucwords($email);
    }

    // to generate code for verification
    public static function generateVerificationCode()
    {
        return Str::random(45);
    }
}
