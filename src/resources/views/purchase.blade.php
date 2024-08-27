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
                @if(app()->environment('local'))
                    <img src="{{ asset('storage/image/' . $item->image) }}" alt="商品画像">
                @else
                    <img src="{{ Storage::disk('s3')->url('image/'.$item->image) }}" alt="商品画像">
                @endif
            </div>
            <div class="item-info__right">
                <h3>{{ $item->name }}</h3>
                <p>&yen;{{ $item->price }}</p>
            </div>
        </div>
        <div class="payment-method">
            <div class="payment-method__left">
                <p>支払い方法</p>
                <p></p>
            </div>
            <div class="payment-method__right">
                <a href="{{ url('/purchase/payment_method/' . $item->id ) }}">変更する</a>
            </div>
        </div>
        <div class="delivery-address">
            <div class="delivery-address__left">
                <p>配送先</p>
                <p></p>
            </div>
            <div class="delivery-address__right">
                <a href="{{ url('/purchase/address/' . $item->id ) }}">変更する</a>
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
                    <td>{{ $payment_method }}</td>
                </tr>
            </table>
        </div>
        <div class="purchase-submit">
            <form action="{{ url('/purchase/' . $item->id ) }}" method="post">
                @csrf
                <button>購入する</button>
            </form>
            <div class="alert">
                @foreach ($errors->all() as $error)
                {{ $error }}
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection