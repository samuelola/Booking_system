<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function store(Request $request){
        $url = "https://api.paystack.co/transaction/initialize";
        $fields = [
            'email' => $request->email,
            'amount' => $request->amount * 100,
            'callback_url' => $request->callback_url
        ];

        $key = "Bearer sk_test_bd26d3bef795b1b0896128cc607ce244af635f69";
        $data_string = json_encode($fields);

        //open connection
       $curl = curl_init();
        
        //set the url, number of POST vars, POST data
        curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data_string,
                CURLOPT_HTTPHEADER => array(
                  'Content-Type: application/json',  
                  "Authorization: $key"
                ),
              ));
        
        //execute post
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $ress = json_decode($response);

        return $ress;

    }

}
