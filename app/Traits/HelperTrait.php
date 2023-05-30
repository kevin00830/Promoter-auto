<?php

namespace App\Traits;
use GuzzleHttp\Client;


trait HelperTrait 
{
    function sendWAMessage($number, $message, $delay = 3)
    {
        sleep($delay);
    
        $instance = '50775_all_asks';
    
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.321dbase.com/wp/sendMsg',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query(array(
                'instancia' => $instance,
                'number' => $number,
                'msg' => $message,
            )),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
            ),
        ));
    
        $response = curl_exec($curl);
    
        curl_close($curl);
    
        return $response;
    }

}