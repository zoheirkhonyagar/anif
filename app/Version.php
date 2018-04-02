<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $guarded = [];


    public function interface()
    {
        return $this->belongsTo(Version::class);
    }
}
