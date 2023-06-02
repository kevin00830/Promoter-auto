<?php

namespace App\Http\Controllers\GroupAdmin;

use App\Http\Controllers\Controller;
use App\Models\Flow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlowController extends Controller
{

    public function flowbuilder(Request $request) {
        return view('groupadmin.dashboard.flowbuilder');
    }

    public function addFlow(Request $request) {

        $data = json_decode($request->getContent(), true);
        $group_id =auth()->user()->id;

        // Extract the relevant data (keyword, template, delay...) for each item in the JSON object.
        $dataToSave = [];

        foreach($data['Home']['data'] as $node) {
            $record = new Flow;
            $record->flow_id = $node['id'];
            $record->group_id = $group_id;
            $record->keywords = $node['data']['keyword'];
            $record->next = '';
            $record->tmp_type = 1;
            $record->auto_flow = '';
            $record->reply = $node['data']['message'];
            $record->image_link = $node['data']['imagepath'];
            $record->delay = $node['data']['delay'];
            $record->save(); // this will auto-generate the ID for the record

            if (empty($node['outputs']['output_1']['connections'])) {
                // if output connections are null, set 'next' column to 0
                $next = 0;
            } else {
                // if output connections exist, set 'next' column to 1
                $next = 1;

                // find the related flow record
                $record->auto_flow = $node['outputs']['output_1']['connections'][0]['node'];
            }

            // update 'next' column
            $record->next = $next;
            $record->save();
        }

        // Return a response indicating success.
        return response()->json(['message' => 'Data saved successfully']);
    }
}
