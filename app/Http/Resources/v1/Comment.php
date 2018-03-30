<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\Resource;
use Morilog\Jalali\jDate;
use Morilog\Jalali\jDatetime;

class Comment extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {

        $date = jDate::forge($this->created_at)->ago();

        $tmpDate = explode(' ', $date);
        if($tmpDate[1] == 'هفته')
            $date = jDatetime::strftime('Y/m/d', $this->created_at);

        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'user_id' => $this->user_id,
            'point' => $this->point,
            'text' => $this->text,
            'point_id' => $this->point_id,
            'agree_count' => $this->agree_count,
            'against_count' => $this->against_count,
            'full_name' => $this->first_name .' '.$this->last_name,
            'date' => $date ,
        ];
    }
}
