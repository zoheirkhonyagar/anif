<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferredUser extends Model
{
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function regent()
    {
        return $this->belongsTo(User::class);
    }
}
