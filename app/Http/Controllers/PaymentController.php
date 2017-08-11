<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Softon\Indipay\Facades\Indipay;
use Auth;
use Response;
// Model
use App\ClientDetails;
use App\ClientPaymentsAggrement;
use App\RequestPayment;
use App\Timeline;

class PaymentController extends Controller
{
    public function ClientPay(Request $request){
    	$inputData = $request->all();
    	$clientId = (int)$inputData['clientId'];

    	// Getting Client Details
    	$ClientDetails = ClientDetails::where('ClientDetails.id',$clientId)
    								->join('Users','Users.id','=','ClientDetails.id')
    								->first();

    	// Indipay Parameters
		$key = "uWq3IWpo";
    	$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
    	$amount = (float)$inputData['amount'];
    	$productinfo = "Product Info";
    	$firstname = $ClientDetails->firstName;
    	$email = $ClientDetails->email;
    	$phone = $ClientDetails->MobileNo;
    	$salt = "rKawV2ZolS";
		// Hash ----------------
		$hashSeq=$key.'|'.$txnid.'|'.$amount.'|'.$productinfo.'|'.$firstname.'|'.$email.'|||||||||||'.$salt;
    	$hash = strtolower(hash('sha512', $hashSeq));

		$parameters = [
			'txnid' => $txnid,
			'firstname' => $firstname,
			'email' => $email,
			'phone' => $phone,
			'productinfo' => "Product Info",
			'amount' => $amount,
			'hash' => $hash
      	];
      	$order = Indipay::prepare($parameters);
      	return Indipay::process($order);
    }
    public function PaymentSuccess(Request $request){
    	$response = Indipay::response($request);

    	// Save The Data to ClientPayment
    	

    	// 
    }
    public function PaymentFailed(Request $request){
    	$response = Indipay::response($request);
    }
    public function RequestPayment(Request $request){
        // dd("I'm Here");
        $inputData = $request->all();
        $caseId = (int)$inputData['caseId'];
        $clientId = (int)$inputData['clientId'];
        $comment = (int)$inputData['comment'];
        $amount = (float)$inputData['amount'];
        $lawyerId = Auth::id();

        //  Adding Data to Request Payment ----------
        $id = RequestPayment::insertGetId(
            array('amount' => $amount, 'toClient' => $clientId, 'forCaseId' => $caseId, 'lawyerId' => $lawyerId, 'status' => 'ApprovalPending')
        );
        // Adding To Timeline ----------------
        $tl = new Timeline;
        $tl->Action = "PaymentRequested";
        $tl->lawyerId = $lawyerId;
        $tl->caseId = $caseId;
        $tl->RefId = $id;
        $tl->save();
        // Returning Success
        return Response::json(array(
            'Status' => "PaymentRequested",
        ));
    }
}
