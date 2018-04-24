<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $guarded = [];


    public function interfaceM()
    {
        return $this->belongsTo(Version::class);
    }
}
