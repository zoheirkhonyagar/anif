<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\Resource;

class Regent extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $imageUrl = 'http://anif.ir/images/zahedan.jpg' ;
        $txt = "آنیف رو به دوستات معرفی کن و تی ام هدیه بگیر فقط کافیه بگی که کد منحصر به فرد خودت رو به عنوان کارت شارژ تی ام داخل اپلیکیشن وارد کنن و ادن ها هم 5000 تی ام هدیه بگیرن.";


        return [
            'img' => $imageUrl,
            'explain' => $txt,
            'id' => $this->id,
            'code' => $this->code,
            'user_id' => $this->user_id,
            'intro_point' => $this->intro_point,
            'created_at' => $this->created_at,

        ];
    }



}
