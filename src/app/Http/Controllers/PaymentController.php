<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class PaymentController extends Controller
{
    //決済機能(Stripe)
    public function payment(Request $request)
    {
        $payment = Payment::where('order_id', $request->order_id)->first();

        Stripe::setApiKey(env('STRIPE_SECRET'));
        Charge::create([
            'amount' => $payment->order->item->price,
            'currency' => 'jpy',
            'source' => $request->stripeToken,
            'description' => 'Test payment',
        ]);

        Payment::where('order_id', $request->order_id)->update(['status' => true]);

        return view('payment_complete');
    }
}
