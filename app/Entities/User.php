<?php

namespace App\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "users";
    protected $primaryKey = "id";



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name',
        'email',
        'password',
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
        'user_name'          => 'string',
        'id'                => 'integer',
        'email_verified_at' => 'datetime',
        'email'             => 'string',
        'password'          => 'string',
        'adminPermissions'  => 'boolean',
        'remember_token'    => 'string',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
