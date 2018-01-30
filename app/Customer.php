<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
//    protected $fillable = ['id', 'store_id', 'user_id', 'TM', 'all_TM', 'created_at'];
    protected $guarded = [];


    public function Store()
    {
        return $this->belongsTo(Store::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
