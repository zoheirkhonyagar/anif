<?php

namespace App\Http\Controllers\Api\v1;

use App\Comment;
use App\Http\Resources\v1\Comment as CommentResource;
use App\Http\Resources\v1\User;
use App\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends apiController
{
    protected $messageUniqueAddress = 'نام آدرس وارد شده وجود دارد ، نام آدرس دیگری انتخاب کنید.';

    public function getAddress()
    {
        $addressM = auth()->user()->address()->where('is_active', 1)->get() ;
        return $this->respondTrue($addressM);
    }

    public function update(Request $request)
    {
        $validData = $this->validate($request, [
                'address_id' => 'required','exists:addresses,id',
                'nick_name' => 'required|string|max:100',
                'address' => 'required|string|max:255',
            ]
        );

        $addressM = UserAddress::find($validData['address_id']) ;

        $addressUnique = auth()->user()->address()
            ->where('nick_name', $validData['nick_name'])
            ->where('id','!=' ,$addressM->id)
            ->get() ;

        if($addressUnique->count() != 0) {

            return $this->respondSuccessMessage('not valid nick_name', $this->messageUniqueAddress);
        }

        $addressM->nick_name = $validData['nick_name'] ;
        $addressM->address = $validData['address'] ;
        $addressM->save() ;

        return $this->RespondCreated('تغییرات ذخیره شد.') ;
    }

    public function storeAddress(Request $request)
    {
        $validData = $this->validate($request, [
                'nick_name' => 'required|string|max:100',
                'address' => 'required|string|max:255',
            ]
        );

        $addressM = auth()->user()->address()->where('nick_name', $validData['nick_name'])->get() ;

        if($addressM->count() == 0)
            auth()->user()->address()->create(
                $validData
            );
        else
            return $this->respondSuccessMessage('not valid nick_name', $this->messageUniqueAddress);

        return $this->RespondCreated('.آدرس جدید شما به مشخصات تون اضافه شد') ;
    }

    public function delete(Request $request)
    {
        $validData = $this->validate($request, [
                'nick_name' => 'required|string|max:100',
                'address' => 'required|string|max:255',
            ]
        );

        $addressM = UserAddress::find($validData['address_id']) ;

        $addressM->delete() ;

        $this->RespondDeleted('آدرس انتخابی شما حذف شد.') ;

    }

}
