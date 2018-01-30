<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreCategory extends Model
{
    protected $guarded = [];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }


    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
