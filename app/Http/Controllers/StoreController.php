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
        $temp_store = [];
        foreach ($stores as $store)
        {
            $tmp = DB::table('products')->select(DB::raw('max(off) as maxOff'))->where('store_id', $store['id'])->first();
            if ($tmp->maxOff){
                $store['max_off'] = $tmp->maxOff;
                $temp_store [] = $store;
            }

        }

        $temp_store = collect($temp_store);

        $storesWithRank = Store::orderBy('rank', 'desc')->limit(5)->get(); //اطلاعات 5 تا از بهترین مجموعه های آنیف

        $sortedWithOff = $temp_store->sortByDesc('max_off')->values()->all(); // تمام مجموعه های آنیف رو بر اساس بالاترین تخفیف سورت می کنه

        //view('main.main-page.components.best-restaurant' , compact( 'storesWithRank') );

        return view('main.main-page.index' , compact( 'sortedWithOff' , 'storesWithRank'));

    }
}
