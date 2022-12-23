<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller{
        /**
   * Create new payment.
   *
   * @param  Request  $request
   * @return redirect
   */
  public static function payment(Request $request){
    
    $payment = new Payment;
    $payment->value = $request['value'];
    $payment->id_bidder = $request['id_bidder'];
    $payment->id_auctioneer = $request ['id_auctioneer'];
    $payment->id_auction = $request['id_auction'];
    $payment->save();

    return response()->json(['id_auction'=>$request['id_auction'],'id_bidder'=>$request['id_bidder'],'value'=>$request['value'],'id_bidder' => $request['id_bidder']],200);
  }

    /**
   * Check if payment is done.
   *
   * @param  Request  $request
   * @return boolean
   */
  public static function checkPayment($id_auction){
    foreach(Payment::all() as $payment){
        if($payment->id_auction == $id_auction){
            return true;
        }
    }
    return false;
  }
}

?>