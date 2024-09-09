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
@component('components.menu2') 
@endcomponent
<div class="alert">
    メールアドレスの認証が完了していません。メールを確認し、認証を完了してください。
</div>
@endif
@else
@component('components.menu2')
@endcomponent
@endif
@endsection


@section('content')

<div class="index-inner">
    <div class="index-button">
        <div class="index-button-inner">
            <button><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">おすすめ</a></button>
            <button><a href="/myfavourite" class="{{ request()->is('myfavourite') ? 'active' : '' }}">マイリスト</a></button>
        </div>
    </div>

    <div class="items">
        @foreach($items as $item)
        <div class="item-cards">
            <div class="item-cards__img">
                <a href="{{ url('/item/' . $item->id) }}">
                    @if(app()->environment('local'))
                        <img src="{{ asset('storage/image/' . $item->image) }}" alt="">
                    @else
                        <img src="{{ Storage::disk('s3')->url('image/'.$item->image) }}" alt="">
                    @endif
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