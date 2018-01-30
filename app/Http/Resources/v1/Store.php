<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\Resource;

class Store extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        if($this->explain == null)
            $this->explain = '';
        if($this->rank == null)
            $this->rank = -1;
        $getUrl = url('/');
        $url = $getUrl.'/images/stores/'.$this['id'].'/';
        $arrImg = unserialize($this['images']);
        $tmpSlider = [];
        foreach ($arrImg['images']['slides'] as $item)
        {

            $tmpSlider[] = $item['200'];
        }

        $arrImg['icon'] = $url. $arrImg['icon'];
        if($this->is_online_order == 0)
        {
            $arrImg['icon'] = $getUrl.'/images/'.'icon-close.png';
        }

        return [
            'id' => $this->id ,
            'name' => $this->name ,
            'username' => $this->username ,
            'telephone_number' => $this->telephone_number ,
            'address' => $this->address ,
            'rank' => $this->rank ,
            'member_count' => $this->member_count ,
            'explain' => $this->explain ,
            'images' => $tmpSlider ,
            'working_hours' => $this->working_hours ,
            's_category_id' => $this->s_category_id ,
            'menu_link' => $this->menu_link ,
            'delivery_time' => $this->delivery_time ,
            'delivery_cost' => $this->delivery_cost ,
            'is_online_order' => $this->is_online_order ,
            'is_table_reservation' => $this->is_table_reservation ,
            'sort_weight' => $this->sort_weight ,
            'is_open' => $this->is_online_order ,
            'latitude' => $this->latitude ,
            'longitude' => $this->longitude ,
            'telegram_link' => 'https://t.me/zahedanAnifBot',
            'max_off' => $this->max_off ,
            'icon' =>  $arrImg['icon'] ,
            'image' => $url. $arrImg['images']['slides'][0]['200'] ,
            'created_at' => $this->created_at ,
        ];
    }
}
