<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\v1\Version as VersionResource;
use App\Version;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VersionController extends apiController
{


    public function get(Request $request)
    {

        $validData = $this->validate($request, [
                'id' => 'required','exists:versions,id',
            ]
        );

        $versionModel = Version::find($validData['id']);
        if($versionModel && ($versionModel->is_forced == 1 || $versionModel->is_recommend == 1))
        {
            $versionModel = $versionModel->first();
            $versionUpdate = Version::where('interface_id', '=', $versionModel->interface_id)->orderBy('created_at', 'desc');
            $versionModel['update_link'] = null ;
            if($versionUpdate && $versionUpdate->first()->id != $versionModel->id)
            {
                $versionUpdate = $versionUpdate->first();
                $versionModel['update_link'] = $versionUpdate->link;

            }

        }
        $versionModel = new VersionResource($versionModel);
        return $this->respondTrue($versionModel);
    }
}
