<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class ChargeController extends Controller
{
    //　単発決済用のコード
    public function charge(Request $req){
        try{
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $customer = Customer::create(array(
                'email' => $req->stripeEmail,
                'source' => $req->stripeToken,
            ));
            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => 1000,
                'currency' => 'jpy'
            ));

            return back();

        }catch(\Exception $ex){
            return $ex->getMessage();
        }
    }
}
