<?php

namespace App\Http\Controllers\GroupAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class RdStationController extends Controller
{
    /**
     * Show the groupadmin dashboard.
     * 
     * @return \Illuminate\View\View
     */
   

     public function index(){
       
        $data = DB::table("api_rdstation")->first();
        return view('groupadmin.dashboard.rdstation',compact('data'));
      
    }
}
