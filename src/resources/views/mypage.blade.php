@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('header')
@component('components.menu3')
@endcomponent
@endsection


@section('content')

<div class="mypage-inner">

    <div class="user-info">
        <div class="user-info-inner">
            <img src="" alt="profile">
            <h2>{{ $user->name }} さん</h2>
            <a href="/mypage/profile">プロフィールを編集</a>
        </div>
    </div>

    <div class="mypage-button">
        <div class="mypage-button-inner">
            <button><a href="/mypage">出品した商品</a></button>
            <button><a href="/mypage">購入した商品</a></button>
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