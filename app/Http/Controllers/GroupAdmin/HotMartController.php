<?php

namespace App\Http\Controllers\GroupAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\ApiHotmart;


class HotMartController extends Controller
{
    /**
     * Show the groupadmin dashboard.
     * 
     * @return \Illuminate\View\View
     */
   

     public function index(){
       
       $group_id =auth()->user()->id;
       $data = ApiHotmart::where('groupid',$group_id)->first();
       
       return view('groupadmin.dashboard.hotmart',compact('data'));
    }
    
    public function updateKey(Request $request) {
        
        // Validate the request
        $request->validate([
            'token' => 'required',
        ]);
        
        $group_id =auth()->user()->id;
        
        $apiHotmart = ApiHotmart::where('groupid', $group_id)->first();

        if ($apiHotmart) {
            // If record exists, update it
            $apiHotmart->update(['token' => $request->token]);
        } else {
            // If record doesn't exist, create a new one
            $apiHotmart = ApiHotmart::create(['groupid' => $group_id, 'token' => $request->token]);
        }
        
        return redirect()->back()->with('message', 'Key updated successfully');
        
    }
    
}
