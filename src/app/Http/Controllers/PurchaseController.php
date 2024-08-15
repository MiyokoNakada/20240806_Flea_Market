<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class PurchaseController extends Controller
{
    //商品購入ページ表示
    public function purchase($item_id)
    {
        $item = Item::find($item_id);

        return view('purchase', compact('item'));
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
