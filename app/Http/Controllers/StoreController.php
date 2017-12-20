<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class StoreController extends Controller
{
    public function index()
    {
        $sortedWithOff = $this->getOfferStores();
        $sortedWithOff = $sortedWithOff['stores'];

        $storesWithRank = $this->getBestStores();
        $storesWithRank = $storesWithRank['stores'];

        return view('main.main-page.index' , compact( 'sortedWithOff' , 'storesWithRank'));

    }

    /**
     * @return mixed
     */
    public function getOfferStores($perPage = 9, $currentPage = 1)
    {

        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });


        $storesWithPaginate = Store::paginate($perPage);
        $temp_store = [];
        $stores = $storesWithPaginate->items();
        foreach ($stores as $store) {
            $tmp = DB::table('products')->select(DB::raw('max(off) as maxOff'))->where('store_id', $store['id'])->first();
            if ($tmp->maxOff) {
                $store['max_off'] = $tmp->maxOff;
                $temp_store [] = $store;
            }

        }

        $temp_store = collect($temp_store);

        $sortedWithOff = $temp_store->sortByDesc('max_off')->values()->all();

        $sortedWithOff = [
            'stores' => $sortedWithOff,
            'paginate' => $this->getPaginationInfo($storesWithPaginate)
        ];

        return $sortedWithOff; // تمام مجموعه های آنیف رو بر اساس بالاترین تخفیف سورت می کنه
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getBestStores($perPage = 5, $currentPage = 1)
    {
//        $storesWithRank = Store::orderBy('rank', 'desc')->limit(5)->get();

        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });
        $storesWithRank = Store::orderBy('rank', 'desc')->paginate($perPage);

        $storesWithRank = [
            'stores' => $storesWithRank->items(),
            'paginate' => $this->getPaginationInfo($storesWithRank)
        ];

        return $storesWithRank; //اطلاعات 5 تا از بهترین مجموعه های آنیف
    }


    protected function getPaginationInfo($data)
    {
        return [
            'total' => $data->total(),
            'current_page' => $data->currentPage(),
            'last_page' => $data->lastPage(),
            'next_page_url' => $data->nextPageUrl(),
            'prev_page_url' => $data->previousPageUrl(),
            'limit' => $data->perPage()
        ];
    }
}
