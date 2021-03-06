<?php

namespace App;

use App\Region;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Store extends Model
{
    use Sluggable;
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

    public function region()
    {
        return $this->hasMany(Region::class);
    }

    public function regions()
    {
        return $this->belongsToMany(Region::class , 'store_regions' , 'store_id' , 'region_id' )->withPivot('city_id');
    }

    public function point()
    {
        return $this->hasMany(StorePoint::class, 'point_id', 'id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'username' => [
                'source' => 'username',
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'username';
    }

}
