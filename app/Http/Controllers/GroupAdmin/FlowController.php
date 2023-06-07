<?php

namespace App\Http\Controllers\GroupAdmin;

use App\Http\Controllers\Controller;
use App\Models\Flow;
use App\Models\MenuConnection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FlowController extends Controller
{

    public function flowbuilder(Request $request)
    {
        return view('groupadmin.dashboard.flowbuilder');
    }

    public function addFlow(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $group_id =auth()->user()->id;

        //delete data by group_id in flow and menu_connections table.
        DB::connection('mysql2')->table('flows')->where('group_id', $group_id)->delete();
        DB::connection('mysql2')->table('menu_connections')->where('group_id', $group_id)->delete();

        // save data
        foreach($data['Home']['data'] as $node) {
            $record = new Flow;
            $record->flow_id = $node['id'];
            $record->group_id = $group_id;
            $record->keywords = $node['data']['keyword'];
            $record->next = '';
            $record->tmp_type = 1;
            $record->auto_flow = '';
            $record->reply = $node['data']['message'] ?? '';
            $record->image_link = $node['data']['imagepath'] ?? '';
            $record->delay = $node['data']['delay'] ?? 3;
            $record->save(); // this will auto-generate the ID for the record

            if(empty(($node['outputs']['output_1']['connections']))) {
                // if output connections are null, set 'next' column to 0
                $next = 0;
            } else {
                if (count($node['outputs']['output_1']['connections']) == 1) {
                    // if output connections exist, set 'next' column to 1
                    $next = 1;

                    // find the related flow record
                    $record->auto_flow = $node['outputs']['output_1']['connections'][0]['node'];
                } else if(count($node['outputs']['output_1']['connections']) > 1) {
                    // if output connections are more than 1, set 'next' column to 0 and tmp_type to 500
                    $next = 0;
                    $record->tmp_type = 500;

                    //save data in menu_connections table
                    foreach($node['outputs']['output_1']['connections'] as $menu_node) {
                        $menu = new MenuConnection();
                        $menu->menu_flow_id = $node['id'];
                        $menu->group_id = $group_id;
                        $menu->child_flow_id = $menu_node['node'];
                        $menu->save(); // this will auto-generate the ID for the record
                    }
                }
            }

            // update 'next' column
            $record->next = $next;
            $record->save();
        }

        // Return a response indicating success.
        return response()->json(['message' => 'Data saved successfully']);
    }

    public function exportJson(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        File::put(public_path('flow-json/test.json'), json_encode($data));
        return response()->json(['message' => 'Data exported successfully']);
    }

    public function importJson(Request $request)
    {
        $data = $request->getContent();
        $importData = File::get(public_path('flow-json/'. $data));
        return response()->json(['importData' => $importData]);
    }
}
