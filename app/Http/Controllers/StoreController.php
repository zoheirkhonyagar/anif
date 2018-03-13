<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddWSRequest;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;

class StoreController extends Controller
{
    protected $sliderSizeImage = '640';
    protected $mainImageSize = '200';

    public function index()
    {
		//return auth()->user();
        $sortedWithOff = $this->getOfferStores();
        $sortedWithOff = $sortedWithOff['stores'];

        $storesWithRank = $this->getBestStores(3);
        $storesWithRank = $storesWithRank['stores'];

//        $tmpRequest = AddWSRequest::create('api/v1/addWSRequest', 'POST', [
//            'interface_id' => 1,
//            'position_id' => 1,
//            'day_section_id' => 4,
//            'date' => '2018-1-30',
//            'unique_code' => 192168,
//            'user_id' => 17
//        ]);
//        $response = Route::dispatch($tmpRequest);
//        return $response;die;

        return view('main.main-page.index' , compact( 'sortedWithOff' , 'storesWithRank'));

    }


    public function show(Store $store)
    {
        $store = $this->parseStoreImage($store);
        $categories = Store::find($store->id)->productCategory()->with('product')->get();
        if($categories)
        return view('main.single-stores.show', compact('store','categories'));
//        return $store;
    }

    /**
     * @return mixed
     */

    public function parseStoreImage($store)
    {
//      $url = 'http://anif.ir/'.'images/stores/'.$store['id'].'/';
        $getUrl = url('/');
        $url = $getUrl.'/images/stores/'.$store['id'].'/';
        $arrImg = unserialize($store['images']);
        $tmpSlider = [];
        foreach ($arrImg['images']['slides'] as $item)
        {

            $tmpSlider[] = $url.$item[$this->sliderSizeImage];
        }

        //قرار دادن لوگو تعطیل بودن مجموعه
        $store['icon'] = $url.$arrImg['icon'];
        if($store->is_online_order == 0)
        {
            $store['icon'] = $getUrl.'/images/stores/'.'icon-close.png';
        }

        $store['image'] = $url.$arrImg['images']['main'][$this->mainImageSize];

        $store['images'] = $tmpSlider;
        return $store;
    }
    public function getOfferStores($perPage = 9, $currentPage = 1, $decodeImages = true, $cityId = 1, $region_id = 0, $sortBy = 'max_off', $sortType = 'desc', $storeCategory = 0)
    {

        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        if($region_id == 0)
        {
            if($storeCategory == 0)
                $storesWithPaginate = Store::whereRaw("city_id = $cityId")->paginate($perPage);
            else
                $storesWithPaginate = Store::where("city_id", '=', $cityId )->where("s_category_id" ,'=', $storeCategory)->paginate($perPage);

        }
        else
        {
            if($storeCategory == 0)
            {
                $storesWithPaginate = Store::join('store_regions', function ($join) use ($region_id) {
                    $join->on('stores.id', '=', 'store_regions.store_id')
                        ->where('store_regions.region_id', '=', $region_id);
                })->paginate($perPage);
            }
            else if($storeCategory != 0)
            {
                $storesWithPaginate = Store::join('store_regions', function ($join) use ($region_id, $storeCategory) {
                    $join->on('stores.id', '=', 'store_regions.store_id')
                        ->where("store_regions.region_id" ,'=' ,$region_id)->where("stores.s_category_id", '=' ,$storeCategory);
                })->paginate($perPage);
            }
        }
//        $storesWithPaginate = DB::table('stores')->paginate($perPage);
        $temp_store = [];
        $stores = $storesWithPaginate->items();
//        dd($storesWithPaginate);die;
//        $tmp = [];

//        $stores = (array)$stores;
        foreach ($stores as $store) {
//            var_dump($store);
            $tmp = DB::table('products')->select(DB::raw('max(off) as maxOff'))->
                            where('store_id', $store['id'])->first();
//            dd($tmp);
            if ($tmp->maxOff) {
                $store['max_off'] = $tmp->maxOff;
                if($decodeImages)//برای دیکد نکردن از سمت وب سرویس
                    $store = $this->parseStoreImage($store);
                $temp_store [] = $store;
            }
        }

        $temp_store = collect($temp_store);

        if($sortType == 'desc')
            $sortedWithOff = $temp_store->sortByDesc($sortBy)->values()->all();
        else
            $sortedWithOff = $temp_store->sortBy($sortBy)->values()->all();

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

        //اضافه کردن آدرس های تصویر هر مجموعه به بخش داده ایش
        $temp_store = [];
        foreach ($storesWithRank->items() as $store)
        {
            $store = $this->parseStoreImage($store);
            $temp_store[] = $store;
        }

        $storesWithRank = [
            'stores' => $temp_store,
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
