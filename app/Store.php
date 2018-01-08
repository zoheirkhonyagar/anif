<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $guarded = [];

    protected $hidden = ['password'];


    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function productCategory()
    {
        return $this->hasMany(ProductCategory::class);
    }

    public function Customer()
    {
        return $this->hasMany(Customer::class);
    }
}
