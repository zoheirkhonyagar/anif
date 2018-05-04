<?php

namespace App;

use App\Region;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['id', 'name', 'fa_name', 'bot_username'];
    protected $table = 'cities';

    public function regions()
    {
        return $this->hasMany(Region::class);
    }

}
