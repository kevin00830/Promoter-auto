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
        $flow_id = count($data['Home']['data']);
        $group_id =auth()->user()->id;

        // Extract the relevant data (keyword, template, delay...) for each item in the JSON object.
        $dataToSave = [];

        foreach($data['Home']['data'] as $node) {
            $record = new Flow;
            $record->flow_id = $flow_id;
            $record->group_id = $group_id;
            $record->keywords = $node['data']['keyword'];
            $record->next = '';
            $record->tmp_type = '';
            $record->auto_flow = '';
            $record->reply = $node['data']['message'];
            $record->image_link = $node['data']['imagepath'];
            $record->delay = $node['data']['delay'];
            $record->save(); // this will auto-generate the ID for the record

            $id[] = $record->id;

            if (empty($node['outputs']['output_1']['connections'])) {
                // if output connections are null, set 'next' column to 0
                $next = 0;
            } else {
                // if output connections exist, set 'next' column to 1
                $next = 1;

                // get the node message from output connection
                $message = $node['data']['message'];

                // find the related flow record
                $related_id = Flow::where( 'reply', '=', $message)->value('id');
                $record->auto_flow = $related_id;
            }

            // update 'next' column
            $record->next = $next;
            $record->save();
        }

        // Return a response indicating success.
        return response()->json(['message' => 'Data saved successfully']);
    }
}
