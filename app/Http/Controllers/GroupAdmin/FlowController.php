<?php

namespace App\Http\Controllers\GroupAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlowController extends Controller
{

    public function flowbuilder(Request $request) {
        return view('groupadmin.dashboard.flowbuilder');
    }

    public function addFlow(Request $request) {

        $group_id =auth()->user()->id;
        $query = array(
            'flow_id' => 1,
            'group_id' => $group_id,
            'keywords' => $request->keyword,
            'next' => '0',
            'tmp_type' => '',
            'auto_flow' => '',
            'reply' => $request->message,
            'image_link' => $request->imagepath,
//            'main_msg' => '',                       not used
//            'main_image' => '',                     not used
            'delay' =>  $request->delay ?? 3
            // 'next' => $request->actions ?? '0',
            // 'auto_flow' => (isset($request->actions) && $request->auto_flow != null && $request->actions != 0) ? $request->auto_flow : "",
        );
        DB::connection('mysql2')->table('flows')->insert($query);
        dd($query);
    }
}
