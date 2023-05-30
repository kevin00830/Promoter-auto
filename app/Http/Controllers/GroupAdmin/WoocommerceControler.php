<?php

namespace App\Http\Controllers\GroupAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\ApiWoocommerce;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Traits\HelperTrait;


class WoocommerceControler extends Controller
{
    /**
     * Show the groupadmin dashboard.
     * 
     * @return \Illuminate\View\View
     */
     
     use HelperTrait;
   

     public function index(){
         
        $group_id =auth()->user()->id;
       
        $woo_data = ApiWoocommerce::where('group_id',$group_id)->first();
        
        return view('groupadmin.dashboard.woocommerce',compact('woo_data','group_id'));
    }
    
    public function updateMessages(Request $request) {
        
        $group_id =auth()->user()->id;
        
        $woo_data = ApiWoocommerce::where('group_id',$group_id)->first();
        
        if($woo_data) {
            
            $woo_data->fill($request->only([
                'pending', 
                'failed', 
                'waiting', 
                'processing', 
                'completed', 
                'refunded', 
                'canceled'
            ]));

             $woo_data->save();

            // Return success response
            return redirect()->back()->with('message', 'Messages updated successfully');
            
        } else {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        }
        
    }
    
    public function generateOAuthUrl(Request $request)
    {
        
        // Validate the request
        $request->validate([
            'url' => 'required|url',
        ]);

        // Get the URL from the request
        $url = $request->input('url');


        $group_id =auth()->user()->id;
        $appName = 'Notifire';
        $userId = $url.','.$group_id;
        $redirectUri = 'https://auto.notifire-api.com/woocommerce/callback';
        $returnUrl = 'https://auto.notifire-api.com/woocommerce';

        // Define the scope of the application
        $scope = 'read_write'; // replace this with your scope

        // Define the WooCommerce authorization endpoint
        $authorizationEndpoint = $url.'/wc-auth/v1/authorize'; // replace this with the WooCommerce OAuth endpoint

        // Build the OAuth URL
        $oauthUrl = $authorizationEndpoint . '?' . http_build_query([
            'app_name' => $appName,
            'user_id' => $userId,
            'callback_url' => $redirectUri,
            'return_url' => $returnUrl,
            'scope' => $scope,
        ]);

        // Redirect the user to the WooCommerce authorization page
        return redirect()->away($oauthUrl);
    }
    
    public function handleCallback(Request $request) {
        
        // Validate the request
        $request->validate([
            'consumer_key' => 'required',
            'consumer_secret' => 'required',
            'user_id' => 'required'
        ]);
        
        $data = explode(",", $request->user_id);
        
        $apiWoocommerce = new ApiWoocommerce;
        $apiWoocommerce->group_id = $data[1];
        $apiWoocommerce->url = $data[0];
        $apiWoocommerce->client_id = $request->consumer_key;
        $apiWoocommerce->client_secret = $request->consumer_secret;
        $apiWoocommerce->save();
        
        
        $this->addWebhook($data[0], $request->consumer_key, $request->consumer_secret);
        
        return true;
        
    }
    
    public function delete($id)
    {
        // Find the record by its ID
        $apiWoocommerce = ApiWoocommerce::where('group_id',$id)->first();

        // Check if the record exists
        if (!$apiWoocommerce) {
            // Redirect with a failure message or throw an exception
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        }

        // Delete the record
        $apiWoocommerce->delete();

        // Redirect with a success message
        return redirect('/woocommerce')->with('success', 'Record deleted successfully');
    }
    
    
    public function addWebhook($url, $consumerKey, $consumerSecret)
    {
        // Endpoint for creating a webhook
        $webhookUrl = $url . '/wp-json/wc/v3/webhooks';
    
        // Data for the new webhook
        $data = [
            'name' => 'Webhook for notfire',
            'topic' => 'order.updated',
            'delivery_url' => 'https://auto.notifire-api.com/woocommerce/order/update',
            'secret' => 'SDNSDJ@#SD@DSjd2@',
        ];
    
        // WooCommerce API authentication
        $auth = base64_encode($consumerKey . ':' . $consumerSecret);
    
        // Make the POST request to create the webhook
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $auth,
        ])->post($webhookUrl, $data);
    
        // Check the response
        if ($response->successful()) {
            // Webhook was created successfully
            return $response->json();
        } else {
            // There was an error
            throw new Exception('Error creating webhook: ' . $response->body());
        }
    }
    
    
    
    public function handleOrderUpdate(Request $request) 
    {
         $this->sendWAMessage('447456457780@c.us', $order->order_number, 1);
         return;
         
        $order = $request->all();
        $url = substr($request->header('x-wc-webhook-source'), 0, -1);
        
        $woo_data = ApiWoocommerce::where('url',$url)->first();
        
        if($woo_data && $order) {
            
             $number = $order->billing_address->phone.'@c.us';
            
            if($order->status == "processing" && $woo_data->processing) {
            
                $this->sendWAMessage($number, $woo_data->processing, 3);
                
            } else if($order->status == "completed") {
                
            }
            
        }
        
        
    }

    
    
}
