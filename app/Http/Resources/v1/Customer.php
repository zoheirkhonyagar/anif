<?php

namespace App\Http\Resources\v1;

use App\Store;
use Illuminate\Http\Resources\Json\Resource;

class Customer extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $storeM = Store::find($this->store_id);
        return [
            'id' => $this->id ,
            'store_id' => $this->store_id ,
            'store_name' => $storeM->name ,
            'user_id' => $this->user_id ,
            'TM' => $this->TM ,
            'all_TM' => $this->all_TM ,
            'created_at' => $this->created_at ,
        ];
    }
}
