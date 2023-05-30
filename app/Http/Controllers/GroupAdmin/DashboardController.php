<?php

namespace App\Http\Controllers\GroupAdmin;

use App\Http\Controllers\Controller;
use App\Models\AutoReplyMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DB;

use Faker\Factory as Faker;




class DashboardController extends Controller
{
    /**
     * Show the groupadmin dashboard.
     * 
     * @return \Illuminate\View\View
     */
    public function index(AutoReplyMessage $modelMessages)
    {
        $group_id =auth()->user()->id;
        $settings =  DB::connection('mysql2')->table('auto_reply_setting')->where('group_id',$group_id)->first();
        
   
        if(empty($settings) ){
            DB::connection('mysql2')->table('auto_reply_setting')->insert(
                    array(
                            'group_id'=>$group_id,
                            'asking'=>0
                        )
                );
        }
        $settings =  DB::connection('mysql2')->table('auto_reply_setting')->where('group_id',$group_id)->first();
        
        $ask = explode(',', $settings->asking);
        
      
        $jsontext =  DB::connection('mysql')->table('group_json')->where('group_id',$group_id)->first();
        
        $radio =  DB::connection('mysql')->table('groups')->where('id',$group_id)->first();
        
        $flows =  DB::connection('mysql2')->table('flows')->where('group_id',$group_id)->get();
        
        $this->_create_storage_director();
        $autoReplyMsg = $this->_get_main_reply($modelMessages, true);
        $autoReplyTEXT = $this->_get_main_text($modelMessages, true);
        return view('groupadmin.dashboard.index', compact('autoReplyMsg','autoReplyTEXT','ask','settings','jsontext','radio','flows'));
    }
    
    public function int_web(AutoReplyMessage $modelMessages){
        $group_id =auth()->user()->id;
        $settings =  DB::connection('mysql2')->table('auto_reply_setting')->where('group_id',$group_id)->first();
        
   
        if(empty($settings) ){
            DB::connection('mysql2')->table('auto_reply_setting')->insert(
                    array(
                            'group_id'=>$group_id,
                            'asking'=>0
                        )
                );
        }
        $settings =  DB::connection('mysql2')->table('auto_reply_setting')->where('group_id',$group_id)->first();
        
        $ask = explode(',', $settings->asking);
        
      
        $jsontext =  DB::connection('mysql')->table('group_json')->where('group_id',$group_id)->first();
        
        $radio =  DB::connection('mysql')->table('groups')->where('id',$group_id)->first();
        
        $flows =  DB::connection('mysql2')->table('flows')->where('group_id',$group_id)->get();
        
        $this->_create_storage_director();
        $autoReplyMsg = $this->_get_main_reply($modelMessages, true);
        $autoReplyTEXT = $this->_get_main_text($modelMessages, true);
        return view('groupadmin.dashboard.flexo_inte_web', compact('autoReplyMsg','autoReplyTEXT','ask','settings','jsontext','radio','flows'));
    }
    
    public function int_web_2(AutoReplyMessage $modelMessages){
        
        $group_id =auth()->user()->id;
        $settings =  DB::connection('mysql2')->table('auto_reply_setting')->where('group_id',$group_id)->first();
        
   
        if(empty($settings) ){
            DB::connection('mysql2')->table('auto_reply_setting')->insert(
                    array(
                            'group_id'=>$group_id,
                            'asking'=>0
                        )
                );
        }
        $settings =  DB::connection('mysql2')->table('auto_reply_setting')->where('group_id',$group_id)->first();
        
        $ask = explode(',', $settings->asking);
        
      
        $jsontext =  DB::connection('mysql')->table('group_json')->where('group_id',$group_id)->first();
        
        $radio =  DB::connection('mysql')->table('groups')->where('id',$group_id)->first();
        
        $groupIds = [50774,50773,50772,50771];
        
        $groups = DB::connection('mysql')->table('groups')
        ->whereIn('id', $groupIds)
        ->get();
        
        $flows =  DB::connection('mysql2')->table('flows')->where('group_id',$group_id)->get();

        // echo "<pre>";
        // print_r($flows);die;
        
        $this->_create_storage_director();
        $autoReplyMsg = $this->_get_main_reply($modelMessages, true);
        $autoReplyTEXT = $this->_get_main_text($modelMessages, true);
        return view('groupadmin.dashboard.inte_web', compact('autoReplyMsg','autoReplyTEXT','ask','settings','jsontext','radio','flows','groups'));
    }
    
     public function custom_ajax(Request $request){
          $group_id =auth()->user()->id;
        $radio =  DB::connection('mysql')->table('groups')->where('id',$group_id)->update(
                    array(
                           
                            'gp_customized'=>$request->val
                        )
                );
     }
    public function del_main(Request $request){
        DB::connection('mysql2')->table('auto_reply_messages')->where('id',$request->id)->update(
                    array(
                           
                            'image_link'=>'',
                            'image_path'=>''
                        )
                );
    }
    public function ajax_save_setting(Request $request){
        $group_id =auth()->user()->id;
     
        $setting = is_array($request->setting)?  implode(',' , $request->setting): '';
        DB::connection('mysql2')->table('auto_reply_setting')->where('group_id',$group_id)->update(
                    array(
                           
                            'asking'=>$setting
                        )
                );
                
                return true;
    }

    public function beta(AutoReplyMessage $modelMessages)
    {
        $autoReplyMsg = $this->_get_main_reply($modelMessages, true);
        return view('groupadmin.dashboard.beta', compact('autoReplyMsg'));
    }

    public function ajax_save_main(Request $request, AutoReplyMessage $modelMessages) {
        if(!$request->reply || empty($request->reply)) {
            return response()->json(array(
                'success' => false,
                'message' => 'Please enter reply message',
            ));
        }
         $reply = trim($request->reply);
        $new_data = [
            'reply' => $reply,
            ];
       
        $mainMsg = $this->_get_main_reply($modelMessages);
           
                    if(isset($request->image) && !empty($request->image)) {
                       
                        $folderPath = public_path()."/uploads/".auth()->user()->id."/autoreply/";
                        $image_parts = explode(";base64,", $request->image);
                        // echo "<pre>";
                        // print_r($image_parts[0]);
                        // exit();
                   
                        if (strpos($image_parts[0], "image/") !== false) {
                        $image_type_aux = explode("image/", $image_parts[0]);
                        }else if(strpos($image_parts[0], "audio/") !== false){
                           $image_type_aux = explode("audio/", $image_parts[0]);
                        }else if(strpos($image_parts[0], "video/") !== false){
                           $image_type_aux = explode("video/", $image_parts[0]);
                        }else{
                           $image_type_aux = explode("application/", $image_parts[0]);
                        }
                     
                        $image_type = $image_type_aux[1];
                        $image_base64 = base64_decode($image_parts[1]);
                        $file = uniqid().'.'.$image_type;
                        
                        if(file_put_contents($folderPath.$file, $image_base64)) {
                            $new_data['image_path'] = "uploads/".auth()->user()->id."/autoreply/".$file;
                            $new_data['image_link'] = 'https://321autoreply.com/uploads/'.auth()->user()->id.'/autoreply/'.$file;
                        }
                    }
             
        
        $modelMessages->where('id', $mainMsg->id)->update($new_data);
        return response()->json(array(
            'success' => true,
            'data' => $mainMsg
        ));
    }
    public function custom_json(Request $request){
        $group_id =auth()->user()->id;
        $settings =  DB::connection('mysql')->table('group_json')->where('group_id',$group_id)->first();
        if(empty($settings) ){
         DB::connection('mysql')->table('group_json')->insert([
                    'group_id' => $group_id,
                    'json_text'=> $request->json_text
                ]);
        }else{
            DB::connection('mysql')->table('group_json')->where('group_id',$group_id)->update([
                    'json_text'=> $request->json_text
                ]);
        }
        
        return redirect()->back();
    } 
    public function web_integeration(Request $request){
        $update = $request->is_update ?? '';
        $flow = $request->flow_id ?? '';
        // dd($request->hasFile('flow_img'));
        $group_id =auth()->user()->id;
        if ($update == 1) {
            if($request->hasFile('flow_img')){
                $file = $request->file('flow_img');
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $imageName);
                $image_url = "https://auto.notifire-api.com/images/$imageName";
            }
            $flow_id = DB::connection('mysql2')->table('flows')->where('id', $flow)->update([
                'group_id' => $group_id,
                'keywords' => $request->keyword,
                'reply' => $request->msg,
                'is_name' => $request->name ?? '0',
                'is_empress' => $request->empress  ?? '0',
                'is_dob' => $request->dob  ?? '0',
                'image_link' => $image_url ?? '', 
            ]);
        
            $blocks = $request->blockno;
            $blocktitles = $request->block_title;
            $btnname = $request->btnname;
            $btnmsg = $request->btnmsg;
            $btnimg = $request->btnimg;
            $blockselect= DB::connection('mysql2')->table('blocks')->where('flow_id', $flow)->orderBy('id', 'ASC')->get();
            
            // echo $flow.' '. count($blocktitles) . ' ' . count($blockselect);
            // exit();
        
            foreach ($blocktitles as $key => $blocktitle) {
                $block__id = $blockselect[$key]->id;
               
                DB::connection('mysql2')->table('blocks')->where('id', $block__id)->update([
                    'block_title' => $blocktitle,
                ]);
                $new_block = DB::connection('mysql2')->table('buttons')->where('block_id', $block__id)->orderBy('id', 'ASC')->get();
                if (isset($btnimg[$key])) {
                    // dd($btnname[$key]);
                    foreach ($btnname[$key] as $key2 => $btn) {
                        $button_id =  $new_block[$key2]->id;
                        // dd($btnimg[$key][$key2]);
                        if(isset($btnimg[$key][$key2])){
                        $image = $btnimg[$key][$key2];
                        $extension = $image->getClientOriginalExtension();
                        $imageName = time() . '_' . $image->getClientOriginalName();
                        $image->move(public_path('images'), $imageName);
                        
                        DB::connection('mysql2')->table('buttons')->where('id', $button_id)->update([
                            'name' => $btn,
                            'msg' => $btnmsg[$key][$key2],
                            'image' => 'https://auto.notifire-api.com/images/' . $imageName,
                        ]);
                            
                        }
                        
                    }
                    
                } else {
                    foreach ($btnname[$key] as $key2 => $btn) {
                        if(isset($new_block[$key2])){
                        $button_id =  $new_block[$key2]->id;
                        DB::connection('mysql2')->table('buttons')->where('id', $button_id)->update([
                            'name' => $btn,
                            'msg' => $btnmsg[$key][$key2],
                            'image' => '',
                        ]);
                        }
                    }
                }
            }
            
    
            
        }
        
        else{
            if($request->hasFile('flow_img')){
                $file = $request->file('flow_img');
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $imageName);
                $image_url = "https://auto.notifire-api.com/images/$imageName";
            }
            $flow_id =  DB::connection('mysql2')->table('flows')->insertGetId(
                    array(
                            'group_id'=>$group_id,
                            'keywords' => $request->keyword,
                            'reply' => $request->msg,
                            'is_name' => $request->name ?? '0',
                            'is_empress' => $request->empress  ?? '0',
                            'is_dob'=> $request->dob  ?? '0',
                            'image_link' => $image_url ?? '',
                        )
                );
        $blocks = $request->blockno;
        $blocktitles = $request->block_title;
        $btnname = $request->btnname;
        $btnmsg = $request->btnmsg;
        $btnimg = $request->btnimg;
 
        foreach($blocktitles as $key => $blocktitle){
            
               $blockid = DB::connection('mysql2')->table('blocks')->insertGetId(
                    array(
                            'block_no'=>$key+1,
                            'flow_id' =>$flow_id, 
                            'block_title'=>$blocktitle,
                        )
                );
                if (isset($btnimg[$key])) {
                foreach($btnname[$key] as $key2 => $btn){
                    if(isset($btnimg[$key][$key2])){
                        $image = $btnimg[$key][$key2];
                        $imageName = time() . '_' . $image->getClientOriginalName();
                        $image->move(public_path('images'), $imageName);
                 DB::connection('mysql2')->table('buttons')->insert(
                    array(
                            'block_id'=>$blockid,
                            'flow_id' =>$flow_id, 
                            'name' => $btn,
                            'msg' => $btnmsg[$key][$key2],
                            'image' => 'https://auto.notifire-api.com/images/'.$imageName,
                        )
                );
                }
            }
                }else{
                    foreach($btnname[$key] as $key2 => $btn){
                   
                 DB::connection('mysql2')->table('buttons')->insert(
                    array(
                            'block_id'=>$blockid,
                            'flow_id' =>$flow_id, 
                            'name' => $btn,
                            'msg' => $btnmsg[$key][$key2],
                            'image' => '',
                        )
                );
                }
                }
            }
        }
            
        return redirect()->back();
    }
    
    public function cloneGroup(Request $request) {
        
        if($request->group_id) {
            
            $group_id =auth()->user()->id;
            $user_group= DB::connection('mysql')->table('groups')->find($group_id);
            
            if($user_group) {
                
                // Get all flows of 
                $all_flows = DB::connection('mysql2')->table('flows')->where('group_id', $request->group_id )->orderBy('id', 'ASC')->get();
                // dd($all_flows);
                if ($user_group) {
                    $all_flows = DB::connection('mysql2')->table('flows')
                        ->where('group_id', $request->group_id)
                        ->orderBy('id', 'ASC')
                        ->get();
                
                    foreach ($all_flows as $flow) {
                        $insertData = [
                            'group_id' => $group_id,
                            'keywords' => $flow->keywords,
                            'reply' => $flow->reply,
                            'next' => $flow->next ?? '0',
                            'auto_flow' => $flow->auto_flow ?? '0',
                            'main_msg' => $flow->main_msg ?? '',
                            'image_link' => $flow->image_link ?? '',
                            'main_image' => $flow->main_image ?? '',
                            'delay' => $flow->delay ?? 3,
                        ];
                
                        DB::connection('mysql2')->table('flows')->insert($insertData);
                    }
                }
                  
            }    
        }
        
        
        return redirect()->back();
        
        
        
    }
    
    public function main_web_integeration(Request $request){
        // dd($request->all());
        $update = $request->is_update_main ?? '';
        $flow = $request->flow_id ?? '';
        $group_id = auth()->user()->id;
        
        if($group_id) {
            $info_ = DB::connection('mysql2')->table('flows')->where('group_id', $group_id)->latest('flow_id')->first();
            $info_2 = DB::connection('mysql2')->table('flows')->where('id', $request->flow_id)->latest('flow_id')->first();
            $next_flow_id = (!empty($info_->flow_id)) ? $info_->flow_id : 1; 
        }
        if ($update == 1) {
            $u = array(
                'group_id' => $group_id,
                'keywords' => (!empty($request->keyword)) ? $request->keyword : '',
                'reply' => $request->msg,
                // 'is_name' => $request->name ?? '0',
                // 'is_empress' => $request->empress  ?? '0',
                // 'is_dob'=> $request->dob  ?? '0',
                'next' => '0',
                // 'next' => $request->actions ?? '0',
                'tmp_type' => $request->tmp_type ?? '',
                // 'auto_flow' => (isset($request->actions) && $request->auto_flow != null && $request->actions != 0) ? $request->auto_flow : "",
                'main_msg' => $request->main_msg ?? '',
                'delay' => $request->delay ?? 3
            );
            
            // dd($u);
            
            if($request->hasFile('flow_img')){
                $file = $request->file('flow_img');
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $imageName);
                $u['image_link'] = $image_url = "https://auto.notifire-api.com/images/$imageName";
            }
            
            if($request->hasFile('main_img')){
                $file2 = $request->file('main_img');
                $imageName2 = time() . '_' . $file2->getClientOriginalName();
                $file2->move(public_path('images'), $imageName2);
                $u['main_image'] = $image_url2 = "https://auto.notifire-api.com/images/$imageName2";
            }
            
            $flow_id = DB::connection('mysql2')->table('flows')->where('id', $flow)->update($u);
            
              if(!empty($next_flow_id)):
                    $flow_id = DB::connection('mysql2')->table('flows')->where('flow_id', $request->auto_flow)
                    ->update(array('next' => '1','auto_flow' => $info_2->flow_id));
                    // die('updated' .$next_flow_id. '-'.$request->auto_flow);
                endif;
        } else {
            $u = array(
                'group_id' => $group_id,
                'flow_id' => $next_flow_id + 1,
                'keywords' => (!empty($request->keyword)) ? $request->keyword : '',
                'reply' => $request->msg,
                // 'is_name' => $request->name ?? '0',
                // 'is_empress' => $request->empress  ?? '0',
                // 'is_dob'=> $request->dob  ?? '0',
                'next' => $request->actions ?? '',
                'tmp_type' => $request->tmp_type ?? '',
                'auto_flow' => (isset($request->actions) && $request->auto_flow != null && $request->actions != 0) ? $request->auto_flow : "",
                'main_msg' => $request->main_msg ?? '',
                'delay' => $request->delay ?? 3
            );
            
            // dd($u);
            
            if($request->hasFile('flow_img')){
                $file = $request->file('flow_img');
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $imageName);
                $u['image_link'] = $image_url = "https://auto.notifire-api.com/images/$imageName";
            }
            
            if($request->hasFile('main_img')){
                $file2 = $request->file('main_img');
                $imageName2 = time() . '_' . $file2->getClientOriginalName();
                $file2->move(public_path('images'), $imageName2);
                $u['main_image'] = $image_url2 = "https://auto.notifire-api.com/images/$imageName2";
            }
            
            $flow_id = DB::connection('mysql2')->table('flows')->insertGetId($u);
        }
        
        return redirect()->back();
    }

    
     public function ajax_save_main_text(Request $request, AutoReplyMessage $modelMessages) {
        if(!$request->reply || empty($request->reply)) {
            return response()->json(array(
                'success' => false,
                'message' => 'Please enter reply message',
            ));
        }

        $reply = trim($request->reply);
        $mainMsg = $this->_get_main_text($modelMessages);

        $modelMessages->where('id', $mainMsg->id)->update(['reply'=>$reply]);
        return response()->json(array(
            'success' => true,
            'data' => $mainMsg
        ));
    }
    
    public function get_flow(Request $request, $flowId) {
        $data =  array();
        $data = DB::connection('mysql2')->table('flows')->where('id', $flowId)->first();
        
        // $data->blocks = DB::connection('mysql2')->table('blocks')->where('flow_id', $flowId)->orderBy('id', 'ASC')->get();
        
        // foreach($data->blocks as $key => $block){
        //     $data->blocks[$key]->buttons = DB::connection('mysql2')->table('buttons')->where('block_id', $block->id)->orderBy('id', 'ASC')->get();
           
        // }
        
        
        // $data = array(
        //     'flows' => $flow,
        //     'blocks' => $blocks,
        //     'buttons' => $buttons,
        // );
         if (!$data) {
        return response()->json(['error' => 'Flow not found'], 404);
        }
        return response()->json($data);
    }
    
     private function _get_main_text(AutoReplyMessage $modelMessages, $hasChild=false) {
        $group_id = auth()->user()->id;

        if($hasChild) {
            $autoReplyMsg = $modelMessages->with('children')
                ->where('group_id', $group_id)
                ->where('keywords', 'MENU_TEXT')
                ->where('replyid', 0)
                ->first();
        } else {
            $autoReplyMsg = $modelMessages->where('group_id', $group_id)
                ->where('replyid', 0)
                ->where('keywords', 'MENU_TEXT')
                ->first();
        }


        if(!$autoReplyMsg) {
            $autoReplyMsg = $modelMessages->create([
                'group_id' => $group_id,
                'keywords' => 'MENU_TEXT',
                'reply' => '',
                'is_image' => 0,
                'image_link' => '',
                'order_num' => 0,
                'replyid' => 0,
            ]);
        }
        return $autoReplyMsg;
    }
    
    public function ajax_save_new(Request $request, AutoReplyMessage $modelMessages){
        
        print_r($request->data);
        
        exit();
    }

    public function ajax_save_option(Request $request, AutoReplyMessage $modelMessages) {

        $option_id = intval($request->id);
        $reply = trim($request->reply);
        $keywords = trim($request->keywords);
        $order_num = intval($request->order_num);

        $mainMsg = $this->_get_main_reply($modelMessages);
        $new_data = [
            'keywords' => $keywords,
            'reply' => $reply,
            'order_num' => $order_num,
            'replyid' => $mainMsg->id,
            'group_id' =>auth()->user()->id,
        ];

        $checkDuplicate = $modelMessages->where('replyid', $mainMsg->id)->where('keywords', $keywords);
        if($option_id > 0) {
            $checkDuplicate = $checkDuplicate->where('id', '!=', $option_id)->get();
        } else {
            $checkDuplicate = $checkDuplicate->get();
        }

        if (count($checkDuplicate) > 0) {
            return response()->json(array(
                'success' => false,
                'message' => 'Already exist same option key',
            ));
        }
        
        if(isset($request->fImage)) {
            switch ($request->fImage) {
                case 1: // changed
                $img = $request->image_link?$request->image_link:$request->image_link2;
               
                    if(isset($request->image_link) && !empty($request->image_link)) {
                        $folderPath = public_path()."/uploads/".auth()->user()->id."/autoreply/";
                        $image_parts = explode(";base64,", $request->image_link?$request->image_link:$request->image_link2);
                        // echo "<pre>";
                        // print_r($image_parts[0]);
                        // exit();
                   
                        if (strpos($image_parts[0], "image/") !== false) {
                        $image_type_aux = explode("image/", $image_parts[0]);
                        }else if(strpos($image_parts[0], "audio/") !== false){
                           $image_type_aux = explode("audio/", $image_parts[0]);
                        }else if(strpos($image_parts[0], "video/") !== false){
                           $image_type_aux = explode("video/", $image_parts[0]);
                        }else{
                           $image_type_aux = explode("application/", $image_parts[0]);
                        }
                     
                        $image_type = $image_type_aux[1];
                        $image_base64 = base64_decode($image_parts[1]);
                        $file = uniqid().'.'.$image_type;
                        if(file_put_contents($folderPath.$file, $image_base64)) {
                            $new_data['image_path'] = "uploads/".auth()->user()->id."/autoreply/".$file;
                            $new_data['image_link'] = 'https://321autoreply.com/uploads/'.auth()->user()->id.'/autoreply/'.$file;
                        }
                    }
                    break;
                case 2: // removed
                    $new_data['image_link'] = '';
                    $new_data['image_path'] = '';
                    break;
                default:
                    break;
            }
        }

        if($option_id > 0) {
            $saved_option = $modelMessages->where('replyid', $mainMsg->id)
                ->where('id', $option_id)
                ->update($new_data);
        } else {
            $saved_option = $modelMessages->create($new_data);
        }

        return response()->json(array(
            'success' => true,
            'data' => $saved_option,
        ));
    }

    public function ajax_del_option(Request $request, AutoReplyMessage $modelMessages) {
        $option_id = intval($request->id);
        $mainMsg = $this->_get_main_reply($modelMessages);
        $modelMessages->where('replyid', $mainMsg->id)->where('id', $option_id)->delete();
        return response()->json(array(
            'success' => true,
        ));
    }
    
     public function del_flow(Request $request) {
    //   dd($request);
       DB::connection('mysql2')->table('flows')->where('id',$request->id)->delete();
    //   DB::connection('mysql2')->table('blocks')->where('flow_id',$request->id)->delete();
    //   DB::connection('mysql2')->table('buttons')->where('flow_id',$request->id)->delete();
    }

    private function _get_main_reply(AutoReplyMessage $modelMessages, $hasChild=false) {
        $group_id = auth()->user()->id;

        if($hasChild) {
            $autoReplyMsg = $modelMessages->with('children')
                ->where('group_id', $group_id)
                ->where('keywords', 'WAKE')
                ->where('replyid', 0)
                ->first();
        } else {
            $autoReplyMsg = $modelMessages->where('group_id', $group_id)
                ->where('replyid', 0)
                ->where('keywords', 'WAKE')
                ->first();
        }


        if(!$autoReplyMsg) {
            $autoReplyMsg = $modelMessages->create([
                'group_id' => $group_id,
                'keywords' => 'WAKE',
                'reply' => '',
                'is_image' => 0,
                'image_link' => '',
                'order_num' => 0,
                'replyid' => 0,
            ]);
        }
        return $autoReplyMsg;
    }

    private function _create_storage_director() {
        $check_path = public_path()."/uploads/".auth()->user()->id."/autoreply/";
        if(!file_exists($check_path) || !is_dir($check_path)) {
            return mkdir($check_path, 0777, true);
        }
        return "passed";
    }
    
     public function hotMart(){
       
        return view('groupadmin.dashboard.hotmart');
    }
    
    public function allInstances() {
        
        $response = Http::post('https://app.321dbase.com/wp/get_instancias');
        
        $instances = null;

        // Handle the response...
        if ($response->successful()) {
            // The POST request was successful...
            $data = $response->json(); // convert the response to JSON
            $instances = $data['retorno']['instancias'];
            // Process the data...
        } else {
            // There was an error...
        }

        return view('groupadmin.dashboard.instances',compact('instances'));
        
    }
    
     public function submitdata(Request $request) {
         $group_id =auth()->user()->id;
         $input = $request->all();
         $table = $input['setting'];
         unset($input["_token"]);
         unset($input["setting"]);
         DB::table("api_".$table)->where("groupid","=",$group_id)->update($input);
          return redirect()->back();
     }
}
