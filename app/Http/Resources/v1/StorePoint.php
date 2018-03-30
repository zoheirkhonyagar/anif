<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\Resource;

class StorePoint extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'user_id' => $this->user_id,
            'point' => $this->point,
            'is_recommend' => $this->is_recommend,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
