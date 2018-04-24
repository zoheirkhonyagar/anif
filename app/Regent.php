<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regent extends Model
{
    protected $guarded = [];


    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function referredUser()
    {
        return $this->hasOne(ReferredUser::class, 'user_id', 'id');
    }
}
