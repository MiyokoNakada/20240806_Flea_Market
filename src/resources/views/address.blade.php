@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('header')
@component('components.menu3')
@endcomponent
@endsection


@section('content')

<div class="delivery-address">
    <div class="delivery-address-inner">
        <h2>住所の変更</h2>

        <form class="delivery-address-form" action="/purchase/address" method="post">
            @csrf
            <input type="hidden" name="item_id" value="{{$item_id}}">
            <div class="delivery-address-form__item">
                <label for="postal_code">郵便番号</label>
                <input type="text" name="postal_code" value="{{ old('postal_code', session('postal_code')) }}">
                <div class="error">
                    @error('postal_code')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="delivery-address-form__item">
                <label for="address">住所</label>
                <input type="text" name="address" value="{{ old('address', session('address')) }}">
                <div class="error">
                    @error('address')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="delivery-address-form__item">
                <label for="building">建物名</label>
                <input type="text" name="building" value="{{ old('building', session('building')) }}">
                <div class="error">
                    @error('building')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="delivery-address-form__submit">
                <button class="delivery-address-form__btn" type="submit">更新する</button>
            </div>
        </form>
    </div>
</div>

@endsection