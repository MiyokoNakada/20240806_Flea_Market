@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('purchase/purchase.css') }}">
@endsection

@section('header')
@component('components.menu3')
@endcomponent
@endsection


@section('content')

<div class="purchase">
    <div class="purcase-inner_left">
        <div class="item-info">
            <img src="" alt="">商品画像
            <h3>商品名</h3>
            <p>price</p>
        </div>
        <div class="payment-method">
            <p>支払い方法</p>
            <p>コンビニ・クレジット・銀行</p>
            <a href="/purchase/payment_method">変更する</a>
        </div>
        <div class="delivery-address">
            <p>配送先</p>
            <p>住所</p>
            <a href="/purchase/address">変更する</a>
        </div>
    </div>
    <div class="purchase-inner_right">
        <div class="purchase-recap">
            <table>
                <tr>
                    <th>商品代金</th>
                    <td>price</td>
                </tr>
                <tr>
                    <th>支払金額</th>
                    <td>price</td>
                </tr>
                <tr>
                    <th>支払い方法</th>
                    <td>コンビニ</td>
                </tr>
            </table>
        </div>
        <div class="purchase-submit">
            <button>購入する</button>
        </div>
    </div>
</div>

@endsection