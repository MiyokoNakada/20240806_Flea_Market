<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Order;
use App\Models\Payment;
use App\Http\Requests\AddressRequest;

class PurchaseController extends Controller
{
    //商品購入ページ表示
    public function purchase($item_id)
    {
        $item = Item::find($item_id);
        $payment_method = $this->paymentMethodInJapanese(session('payment_method'));

        return view('purchase', compact('item', 'payment_method'));
    }

    //支払い方法変更ページ表示
    public function paymentMethod($item_id)
    {
        return view('payment_method', ['item_id' => $item_id]);
    }

    //支払い方法変更機能
    public function changePaymentMethod(Request $request)
    {
        session([
            'payment_method' => $request->payment_method,
        ]);
        $item_id = $request->item_id;
        return redirect(url('purchase/' . $item_id))->with('success', '支払い方法が更新されました。');
    }

    //住所変更ページ表示
    public function addressChange($item_id)
    {
        return view('address', compact('item_id'));
    }

    //住所更新機能
    public function updateAddress(AddressRequest $request)
    {
        session([
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);
        $item_id = $request->item_id;
        return redirect(url('purchase/' . $item_id))->with('success', '住所が更新されました。');
    }

    //商品購入機能→決済用画面表示
    public function completeOrder(Request $request, $item_id)
    {
        $user = Auth::user();
        $postal_code = session('postal_code');
        $address = session('address');
        $building = session('building');
        $original_payment_method = session('payment_method', 'credit_card');
        $payment_method = $this->paymentMethodInJapanese(session('payment_method'));

        if ($postal_code && $address) {
        } else {
            $profile = $user->profile;
            if ($profile) {
                $postal_code = $postal_code ?? $profile->postal_code;
                $address = $address ?? $profile->address;
                $building = $building ?? $profile->building;
            }
        }
        if (!$postal_code || !$address) {
            return redirect()->back()->withErrors(['message' => '住所情報が不足しています。住所を登録してください。']);
        }

        $order = new Order();
        $order->item_id = $item_id;
        $order->user_id = Auth::id();
        $order->postal_code = $postal_code;
        $order->address = $address;
        $order->building = $building;
        $order->save();
        
        Payment::create(['order_id' => $order->id, 'payment_method' => $original_payment_method]);

        Item::find($item_id)->update(['sold' => true]);

        $request->session()->forget(['postal_code', 'address', 'building', 'payment_method']);

        return view('payment', compact('order', 'payment_method'));
    }


    // 日本語表記への変換
    protected function paymentMethodInJapanese($paymentMethod)
    {
        $payment_methods_jp = [
            'credit_card' => 'クレジットカード',
            'convenience' => 'コンビニ払い',
            'bank_transfer' => '銀行振込'
        ];

        return $payment_methods_jp[$paymentMethod] ?? 'クレジットカード';
    }

}
