<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interfaces extends Model
{
    protected $guarded = [];
    protected $table = 'interfaces';



    public function version()
    {
        return $this->hasMany(Version::class);
    }
}
