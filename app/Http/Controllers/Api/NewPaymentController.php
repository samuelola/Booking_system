<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Payment;
use DB;


class NewPaymentController extends Controller
{
    public function payment(Request $request){

        $reference = $request->reference;
        $key = "Bearer sk_test_bd26d3bef795b1b0896128cc607ce244af635f69";
       

         // verify transaction 
        $curl = curl_init(); 

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.paystack.co/transaction/verify/'.$reference,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',  
                "Authorization: $key"
            ),
        ));

        $new_response = curl_exec($curl);
        $err = curl_error($curl);
        $ress_new = json_decode($new_response);
        $reference = $ress_new->data->reference;
        $status = $ress_new->data->status;
        $amount = $ress_new->data->amount/100;
        $gateway_response = $ress_new->data->gateway_response;
        $paid_at = $ress_new->data->paid_at;
        $currency = $ress_new->data->currency;
        $authorization = $ress_new->data->authorization->authorization_code;
        $customer_email = $ress_new->data->customer->email;

        DB::table('payments')->insert(
                [ 
                    'reference' => $reference,
            'status' => $status,
            'amount' => $amount,
            'gateway_response' => $gateway_response,
            'paid_at' => $paid_at,
            'currency' => $currency,
            'authorization_code' => $authorization,
            'email' => $customer_email,
            'created_at' => NOW(),
            'updated_at' => NOW()      
                    ]
            ); 
        
        return redirect()->back();
        
    }
}
