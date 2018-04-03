<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\Resource;
use Morilog\Jalali\jDateTime;

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
        if($this->birthday != null)
            $birthday = jDatetime::strftime('Y/m/d', $this->birthday);
        else
            $birthday = "";
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'anif_code' => $this->anif_code,
            'user_name' => $this->user_name,
            'phone_number' => $this->phone_number,
            'TM' => $this->TM ,
            'all_TM' => $this->all_TM ,
            'birthday' => $birthday ,
            'image' => $this->image ,
            'api_token' => $this->api_token,
        ];
    }
}
