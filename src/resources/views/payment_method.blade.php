@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('header')
@component('components.menu3')
@endcomponent
@endsection


@section('content')

<div class="payment-method">
    <div class="payment-method-inner">
        <h2>支払い方法の変更</h2>

        <form class="payment-method-form" action="/purchase/payment_method" method="post">
            @csrf
            <input type="hidden" name="item_id" value="{{$item_id}}">
            <div class="payment-method-form__item">
                <select name="payment_method">
                    <option value="credit_card">クレジットカード</option>
                    <option value="convenience">コンビニ支払い</option>
                    <option value="bank_transfer">銀行振込</option>
                </select>
                <div class="error">
                    @error('payment_method')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="payment-method-form__submit">
                <button class="payment-method-form__btn" type="submit">更新する</button>
            </div>
        </form>
    </div>
</div>



@endsection