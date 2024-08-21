@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('header')
@component('components.menu3')
@endcomponent
@endsection


@section('content')

<div class="payment">
    <div class="payment-inner">
        <h2>ご購入情報確認</h2>
        <p>支払金額: &yen;{{ $order->item->price }}</p>
        <p>支払い方法: {{ $payment_method }}</p>

        <form action="{{ url('/purchase/' . $order->item->id . '/payment' ) }}" method="POST">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="{{ env('STRIPE_KEY') }}"
                data-amount="{{ $order->item->price }}"
                data-name="Stripe Demo"
                data-label="決済をする"
                data-description="Stripe Demo"
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                data-locale="auto"
                data-currency="JPY">
            </script>
        </form>
    </div>
</div>

@endsection