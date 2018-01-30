<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'first_name' , 'last_name' , 'phone_number', 'password',
=======
        'first_name', 'last_name', 'user_name', 'phone_number', 'email', 'password','api_token', 'anif_code'
>>>>>>> edr
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','api_token'
    ];


    public function Address()
    {
        return $this->hasMany(UserAddress::class);
    }

    public function Customer()
    {
        return $this->hasMany(Customer::class);
    }
}
