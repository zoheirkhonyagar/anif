<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['id', 'name', 'fa_name', 'bot_username'];
    protected $table = 'cities';
}
