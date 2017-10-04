<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::all();

        foreach ($stores as $store)
        {
            $tmp = DB::table('products')->select(DB::raw('max(off) as maxOff'))->where('store_id', $store['id'])->first();
            $store['max_off'] = $tmp->maxOff ;
        }

        $storesWithRank = Store::orderBy('rank', 'desc')->limit(5)->get(); //اطلاعات 5 تا از بهترین مجموعه های آنیف

        $sortedWithOff = $stores->sortByDesc('max_off'); // تمام مجموعه های آنیف رو بر اساس بالاترین تخفیف سورت می کنه

        return $sortedWithOff->values()->all();



    }
}
