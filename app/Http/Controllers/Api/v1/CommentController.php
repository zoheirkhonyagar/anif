<?php

namespace App\Http\Controllers\Api\v1;

use App\Comment;
use App\Http\Resources\v1\Comment as CommentResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends apiController
{

    public function getComment(Request $request)
    {

        $validData = $this->validate($request, [
                'store_id' => 'required','exists:stores,id',
            ]
        );

        $storeId = $validData['store_id'];
        $commentUser = Comment::join('users', function ($join) use ($storeId) {
            $join->on('comments.user_id', '=', 'users.id')
                ->where('comments.store_id', '=', $storeId);
        })->get();

        $arrayComment = [];
        foreach ($commentUser as $item) {
            $arrayComment[] = new CommentResource($item);
            }
        return $this->respondTrue($arrayComment);
    }

}
