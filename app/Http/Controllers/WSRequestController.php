<?php

namespace App\Http\Controllers;

use App\ws_request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WSRequestController extends Controller
{



//    public function insert(Request $request)
//    {
////        $request['date'] = strtotime($request['date']);
//        $validData = $this->validate($request, [
//
//                'position_id' => 'required|exists:anif_positions,id',
//                'day_section_id' => 'required|exists:day_sections,id',
//                'date' => 'required|date',
//                'interface_id' => 'required|exists:interfaces,id',
//                'user_id' => 'exists:users,id',
//                'unique_code' => 'required',
//            ]
//        );
//
//
//
//        $wsRequestM = DB::table('ws_requests')->where(
//            [
//                ['position_id', $request['position_id']],
//                ['interface_id', $request['interface_id']],
//                ['day_section_id', $request['day_section_id']],
//                ['date', $request['date']],
//                ['unique_code', $request['unique_code']],
//            ]);
//
//        if(count($wsRequestM->get()) != 0) //باید شمارنده رو یه دونه بالا ببریم
//        {
//            $wsRequestM->increment('count');
//            return 'ترافیک در این ساعت افزایش یافت';
//        }
//
//
//        $wsRequestM = ws_request::create($validData);
//
//        return $wsRequestM;
//    }
}
