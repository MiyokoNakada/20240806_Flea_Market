<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    //決済機能(Stripe)
    public function payment(Request $request)
    {
        $payment = Payment::where('order_id', $request->order_id)->first();
        $paymentMethod = match ($payment->payment_method) {
            'credit_card' => 'card',
            'convenience' => 'konbini',
            'bank_transfer' => 'customer_balance',
            default => 'card',
        };
        
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $user = Auth::user();
        $customer = Customer::create([
            'email' => $user->email,
        ]);

        $session = Session::create([
            'payment_method_types' => [$paymentMethod],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $payment->order->item->name,
                    ],
                    'unit_amount' => $payment->order->item->price,
                ],
                'quantity' => 1,
            ]],
            
            'mode' => 'payment',
            'customer' => $customer->id,
            'payment_method_options' => [
                'customer_balance' => [
                    'funding_type' => 'bank_transfer',
                    'bank_transfer' => [
                        'type' => 'jp_bank_transfer', 
                    ],
                ],
            ],
            'success_url' => url('/purchase/payment/complete?session_id={CHECKOUT_SESSION_ID}'),
            'cancel_url' => url('/'),
        ]);

        Payment::where('order_id', $request->order_id)->update(['status' => true]);

        return redirect($session->url);
    }

    //決済完了画面表示
    public function paymentComplete()
    {
        return view('payment_complete');
    }
}
