<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $guarded = [];

    protected $hidden = ['password'];
}
