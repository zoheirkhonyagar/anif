<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\Resource;

class Product extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $imgUrl = 'http://anif.ir/images/stores/'.$this['store_id'].'/'.$this['id'].'/main-450.jpg' ;

        if($this->details == null)
            $this->details = '';
        if($this->rank == null)
            $this->rank = -1;
        return [
          'id' => $this->id ,
          'store_id' => $this->store_id ,
          'name' => $this->name ,
          'price' => $this->price ,
          'off' => $this->off ,
          'details' => $this->details ,
          'category_id' => $this->category_id ,
          'count' => $this->count ,
          'active' => $this->active ,
          'rank' => $this->rank ,
          'images' => $this->images ,
          'image' => $imgUrl ,
          'created_at' => $this->created_at ,
        ];
    }
}
