<?php

namespace App;

use App\Store;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $guarded = [];

    public function stores()
    {
        return $this->belongsToMany(Store::class , 'store_regions' , 'store_id' , 'region_id' );
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
