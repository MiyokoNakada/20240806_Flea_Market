@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('header')
@component('components.menu3')
@endcomponent
@endsection


@section('content')

<div class="purchase">
    <div class="purchase-inner-left">
        <div class="item-info">
            <div class="item-info__left">
                <img src="{{ asset('storage/image/' . $item->image) }}" alt="商品画像">
            </div>
            <div class="item-info__right">
                <h3>{{ $item->name }}</h3>
                <p>&yen;{{ $item->price }}</p>
            </div>
        </div>
        <div class="payment-method">
            <div class="payment-method__left">
                <p>支払い方法</p>
                <p>コンビニ・クレジット・銀行</p>
            </div>
            <div class="payment-method__right">
                <a href="/purchase/payment_method">変更する</a>
            </div>
        </div>
        <div class="delivery-address">
            <div class="delivery-address__left">
                <p>配送先</p>
                <p>住所</p>
            </div>
            <div class="delivery-address__right">
                <a href="/purchase/address">変更する</a>
            </div>
        </div>
    </div>

    <div class="purchase-inner-right">
        <div class="purchase-recap">
            <table class="purchase-recap__table">
                <tr>
                    <th>商品代金</th>
                    <td>&yen;{{ $item->price }}</td>
                </tr>
                <tr>
                    <th>支払金額</th>
                    <td>&yen;{{ $item->price }}</td>
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