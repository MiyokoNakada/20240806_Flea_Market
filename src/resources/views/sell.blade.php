@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('header')
@component('components.menu3')
@endcomponent
@endsection


@section('content')

<div class="sell">
    <div class="sell-inner">
        <h2>商品の出品</h2>
        <form class="sell-form" action="/sell" method="post">
            @csrf
            <div class="sell-form__group">
                <label for="image">商品画像</label>
                <div class="sell-form__image">
                    <input type="file" id="upload">
                    <label for="upload" class="sell-form__image-label">画像を選択する</label>
                </div>
            </div>
            <div class="sell-form__group">
                <p>商品の詳細</p>
                <label for="category">カテゴリー</label>
                <input type="text" name="category_id">
                <label for="condirion">商品の状態</label>
                <input type="text" name="condition_id">
            </div>
            <div class="sell-form__group">
                <p>商品名と説明</p>
                <label for="name">商品名</label>
                <input type="text" name="name">
                <label for="detail">商品の説明</label>
                <textarea name="detail" cols="60" rows="6"></textarea>
            </div>
            <div class="sell-form__group">
                <p>販売価格</p>
                <label for="price"></label>
                <input type="text" placeholder="&yen;">
            </div>
            <div class="sell-form__submit">
                <button type="submit">出品する</button>
            </div>
        </form>
    </div>
</div>

@endsection