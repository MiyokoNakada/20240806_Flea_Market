<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function purchase()
    {
        return view('purchase');
    }

    public function paymentMethod()
    {
        return view('payment_method');
    }

    public function addressChange()
    {
        return view('address');
    }
}
