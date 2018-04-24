<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\ApiUpdatePointAndComment;
use App\Http\Requests\ApiUserIdUniqueInStorePoint;
use App\Http\Resources\v1\StorePoint as StoreResourcePoint;
use App\Store;
use App\StorePoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StorePointController extends apiController
{

    protected $factor = 2 ;
    //اول از این متود باید استفاده بشه
    //بعد بستگی به نوع ریسپانس داره
    public function getUserPoint(Request $request)
    {
        $validData = $this->validate($request, [
                'store_id' => 'required','exists:stores,id'
            ]
        );

        $userId = auth()->user()->id;
        $userPoint = StorePoint::where('store_id', $validData['store_id'])
            ->where('user_id', $userId);


        if($userPoint->count() == 0)
            return $this->respondSuccessMessage('This user is not point to this store.','این کاربر به این مجموعه امتیازی نداده است');

        $storePoint = new StoreResourcePoint($userPoint->first());

        return $this->respondTrue($storePoint);
    }

    // اگر کاربر امتیازی تا الان نداده باشه بعد از این استفاده میشه
    public function storePointAndCommentToStore(ApiUserIdUniqueInStorePoint $request)
    {
        $validData = $this->validate($request, [
                'store_id' => 'required|unique:store_points,store_id,NULL,id,user_id,'.auth()->user()->id,
                'point' => 'required',
                'text' => 'required'
            ]
        );

        $storeM = Store::find($validData['store_id']);
        $countUserPoint = DB::table('store_points')->where('store_id', $validData['store_id'])->count();


        if( $countUserPoint == 0)
            $countUserPoint++ ;
        //کدهایی برای محسابه اوریج امتیازهای این رستوران
        $storeM->rank = $this->calcRank($countUserPoint, $storeM->rank, $validData['point']);

        $storeM->save();
        $userPoint = auth()->user()->point()->create([
            'store_id' => $validData['store_id'],
            'point' => $validData['point'],
        ]);
        $userPoint = auth()->user()->comment()->create([
            'store_id' => $validData['store_id'],
            'point_id' => $userPoint->id,
            'text' => $validData['text'],
            'point' => $validData['point'],
        ]);


        return $this->RespondCreated('ممنون، نظر شما بعد از تایید مدیران ذخیره خواهد شد');
    }

    //اگه امتیاز داده بشه از این استفاده میشه
    public function updatePointAndComment(ApiUpdatePointAndComment $request)
    {
        $validData = $this->validate($request, [
//                'store_id' => 'required','exists:stores,id',
                'point_id' => 'required', 'exists:store_points,id',
                'text' => 'required'
            ]
        );

        $pointM = StorePoint::find($validData['point_id']);

        $txtUpdatePoint = ".";
        if(isset($request['point']) && $pointM->point != $request['point'])//این شخص قصد ویرایش امتیاز خودش رو دارد
        {
            $storeM = Store::find($pointM->store_id);
            $countUserPoint = DB::table('store_points')->where('store_id', $storeM->id)->count();

            $count = $this->factor * $countUserPoint + 1 ;
            $storeM->rank = ($storeM->rank * $count - $pointM->point) / $this->factor;//محاسبه رنک بدون این امتیاز

            $storeM->rank = $this->calcRank($countUserPoint, $storeM->rank, $request['point']);

            $pointM->point = $request['point'] ;
            $pointM->save() ;
            $txtUpdatePoint = " و امتیاز قبل شما هم بروزرسانی شد.";
            $storeM->save();
        }
        else
            $request['point'] = $pointM->point ;



        $userPoint = auth()->user()->comment()->create([
            'store_id' => $pointM->store_id,
            'point_id' => $validData['point_id'],
            'text' => $validData['text'],
            'point' => $request['point'],
        ]);


        return $this->RespondCreated('ممنون، نظر شما ذخیره شد'.$txtUpdatePoint);
    }

    public function calcPercentagePoints(Request $request)
    {
        $validData = $this->validate($request, [
                'store_id' => 'required','exists:stores,id'
            ]
        );

        $countAllPoint = DB::table('store_points')->where('store_id', $validData['store_id'])->count();
        $countGood = DB::table('store_points')->where('store_id', $validData['store_id'])->where('point', '>', 3.7)->count();
        $countMedium = DB::table('store_points')->where('store_id', $validData['store_id'])->whereBetween('point', [2.4, 3.7])->count();
        $countWeak = DB::table('store_points')->where('store_id', $validData['store_id'])->whereBetween('point', [1, 2.39])->count();
        $rank = DB::table('stores')->where('id', $validData['store_id'])->select('rank')->first();

        $percentG = 0 ;
        $percentM = 0 ;
        $percentW = 0 ;
        if($countAllPoint != 0) {
            $percentG = $countGood / $countAllPoint * 100;
            $percentM = $countMedium / $countAllPoint * 100;
            $percentW = $countWeak / $countAllPoint * 100;
        }

        $arrayPercent = [
            'rank' => $rank->rank,
            'count_points' => $countAllPoint,
            'good' => $percentG,
            'medium' => $percentM,
            'weak' => $percentW,
        ];

        return $this->respondTrue($arrayPercent) ;

    }

    protected function calcRank($countUserPoint, $rank, $point)
    {
        $count = $this->factor * $countUserPoint + 1;
        $sumAvreg = $rank * $this->factor * $countUserPoint;
        return ($sumAvreg + $point) / ($count);
    }
}
