<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayhereController extends Controller
{
	/**
     * PayHere payment notify method
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function notify(Request $request)
    {
    	// log payhere notify request data 
        \Log::channel('payhere_notify')->info($request->all());

    	$validator = \Validator::make($request->all(), [
	        'merchant_id' => 'required',
			'order_id' => 'required',
			'payment_id' => 'required',
			'payhere_amount' => 'required',
			'payhere_currency' => 'required',
			'status_code' => 'required',
			'md5sig' => 'required',
			'method' => 'required',
			// 'status_message' => 'required',
			// 'card_holder_name' => 'required',
			// 'card_no' => 'required',
			// 'card_expiry' => 'required',
        ]);

        if ($validator->fails())
        	return false;

        $merchant_id	= $request->merchant_id;
        $payment_id		= $request->payment_id;
		$currency 		= $request->payhere_currency;
		$order_id       = $request->order_id;
		$payhere_amount = $request->payhere_amount;	
		$status_code    = $request->status_code;
		$method			= $request->method;

		// $card_holder_name = $request->card_holder_name;
		// $card_no          = $request->card_no;
		// $card_expiry      = $request->card_expiry;

		$md5sig         = $request->md5sig; 

		$local_md5sig = $this->md5sig($merchant_id, $order_id, $amount, $currency, $status_code);
		
		if (($local_md5sig === $md5sig) AND ($status_code == 2) ){
			//TODO: Update your database as payment success
			$payment = new \App\Payment($order_id);
			if(!$payment) 
				return false;

			$payment->status = \App\Payment::SUCCESS;
			$payment->method = $method;

			if($payment->save()) {
				$vendor = \App\User::find($payment->cust_id);
				
				$vendor->status = \App\User::ACTIVE; 
				$vendor->save(); 
	            // send sms to the customer to inform that order status has been changed
			}
			return true;
		}
		return false;
    }

    public function md5sig ($merchant_id, $order_id, $amount, $currency, $status_code) 
    {
        $merchant_secret = env('PAYHERE_MERCHANT_SECRET', '4ZGTLsFYHTu4KEOujcGCax8gkNLXCCopG4fWWYupZaKn');
        // md5 hash algorithm / signature 
        return strtoupper (md5 ( $merchant_id . $order_id . $amount . $currency . $status_code . strtoupper(md5($merchant_secret)) ) );
    }
}
