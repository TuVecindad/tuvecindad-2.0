<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

<<<<<<< HEAD
class User extends Authenticatable implements MustVerifyEmail
{
=======
class User extends Authenticatable {

>>>>>>> a6f4d6aaf9e258ef3d97b5a3f0e68a16c2bce086
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //clave
    protected $primaryKey = 'id';
    protected $fillable = [
        'email', 'name', 'nif', 'name', 'surname1', 'surname2', 'phone1', 'phone2', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','updated_at','created_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
