<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function index()
    {
        $sortedWithOff = $this->getOfferStores();

        $storesWithRank = $this->getBestStores();

        return view('main.main-page.index' , compact( 'sortedWithOff' , 'storesWithRank'));

    }

    /**
     * @return mixed
     */
    public function getOfferStores()
    {
        $stores = Store::all();
        $temp_store = [];
        foreach ($stores as $store) {
            $tmp = DB::table('products')->select(DB::raw('max(off) as maxOff'))->where('store_id', $store['id'])->first();
            if ($tmp->maxOff) {
                $store['max_off'] = $tmp->maxOff;
                $temp_store [] = $store;
            }
        }

        $temp_store = collect($temp_store);

        $sortedWithOff = $temp_store->sortByDesc('max_off')->values()->all();
        return $sortedWithOff; // تمام مجموعه های آنیف رو بر اساس بالاترین تخفیف سورت می کنه
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getBestStores()
    {
        $storesWithRank = Store::orderBy('rank', 'desc')->limit(5)->get();
        return $storesWithRank; //اطلاعات 5 تا از بهترین مجموعه های آنیف
    }
}
