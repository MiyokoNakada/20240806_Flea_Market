@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('header')
@if (Auth::check())
@if (Auth::user()->hasVerifiedEmail())
@component('components.menu3')
@endcomponent
@else
@component('components.menu2') <!-- メール認証未完了 -->
@endcomponent
<div class="alert">
    メールアドレスの認証が完了していません。メールを確認し、認証を完了してください。
</div>
@endif
@else
@component('components.menu2') <!-- ログイン未 -->
@endcomponent
@endif
@endsection


@section('content')

<div class="index-inner">
    <div class="index-button">
        <div class="index-button-inner">
            <button><a href="/">おすすめ</a></button>
            <button><a href="/myfavourite">マイリスト</a></button>
        </div>
    </div>

    <div class="items">
        @foreach($items as $item)
        <div class="item-cards">
            <div class="item-cards__img">
                <a href="{{ url('/item/' . $item->id) }}">
                    <img src="{{ asset('storage/image/' . $item->image) }}" alt="">
                </a>
            </div>
            <div class="item-cards__label">
                <p>{{ $item->name }}</p>
                <p>&yen;{{ $item->price }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection