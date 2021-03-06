<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];


    public function store()
    {
        return $this->belongsTo(Store::class);
    }


    public function Category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
