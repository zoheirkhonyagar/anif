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
        'first_name' , 'last_name' , 'phone_number', 'password','first_name', 'last_name', 'user_name', 'phone_number', 'email', 'password','api_token', 'anif_code','TM','birthday','TM_password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','api_token','TM_password'
    ];


    public function address()
    {
        return $this->hasMany(UserAddress::class);
    }

    public function Customer()
    {
        return $this->hasMany(Customer::class);
    }

    public function point()
    {
        return $this->hasMany(StorePoint::class, 'user_id', 'id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function regent()
    {
        return $this->hasOne(Regent::class, 'user_id', 'id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'user_id', 'id');
    }

}
