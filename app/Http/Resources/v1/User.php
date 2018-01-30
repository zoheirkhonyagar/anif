<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\Resource;

class User extends Resource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'anif_code' => $this->anif_code,
            'user_name' => $this->email,
            'phone_number' => $this->phone_number,
            'api_token' => $this->api_token
        ];
    }
}
