<?php

namespace App\Http\Resources\v1;

use App\City;
use App\Region;
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
        $optionsStore = explode("-", $this['explain']);
        $this['features'] = $optionsStore;
        $city = City::find($this['city_id']);
        $this['telegram_bot'] = "https://telegram.me/".$city['bot_username']."?start=store-".$this['username'];

        $store_id = $this->id;
        $regions = Region::join('store_regions', function ($join) use ($store_id) {
            $join->on('regions.id', '=', 'store_regions.region_id')
                ->where('store_regions.store_id', '=', $store_id);
        })->pluck('name');


        $this['regions'] = $regions;

        if($this->explain == null || $this->explain != null)
            $this->explain = '';
        if($this->crm_TM == 0)
            $this->message_join_crm = "در باشگاه مشتریان ".$this->name." عضو شو و ".$this->message_join_crm;
        else
            $this->message_join_crm = "در باشگاه مشتریان ".$this->name." عضو شو و ".$this->crm_TM." TM"." هدیه بگیر!";

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
            'message_join_crm' => $this->message_join_crm ,
            'features' => $this->features ,
            'regions' => $this->regions ,
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
            'instagram' => $this->instagram ,
            'telegram' => $this->telegram ,
            'telegram_bot' => $this->telegram_bot,
            'max_off' => $this->max_off ,
            'icon' =>  $arrImg['icon'] ,
            'image' => $url. $arrImg['images']['slides'][0]['200'] ,
            'created_at' => $this->created_at ,
        ];
    }
}
