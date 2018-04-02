<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\Resource;

class Version extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id ,
            'name' => $this->name ,
            'version' => $this->version ,
            'is_recommend' => $this->is_recommend ,
            'is_forced' => $this->is_forced ,
            'link' => $this->link ,
            'possibility' => $this->possibility ,
            'explain' => $this->explain ,
            'update_link' => $this->update_link ,
        ];
    }
}
