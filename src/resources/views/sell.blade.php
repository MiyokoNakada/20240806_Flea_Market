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
        <form class="sell-form" action="/sell" method="post" enctype="multipart/form-data">
            @csrf
            <div class=" sell-form__group">
            <label for="image">商品画像</label>
            <div class="sell-form__image">
                <input type="file" id="upload" name="image" accept="image/*" onchange="previewImage(event)">
                <label for="upload" class="sell-form__image-label">画像を選択する</label>
                <img id="imagePreview" class="sell-form__image-preview" src="" alt="" style="display: none;">
            </div>
    </div>
    <div class="sell-form__group">
        <p>商品の詳細</p>
        <label for="category">カテゴリー</label>
        <select name="category_id">
            <option value="{{ old('category_id') }}"></option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endforeach
        </select>
        <label for="condirion">商品の状態</label>
        <select name="condition_id">
            <option value="{{ old('condition_id')}}"></option>
            @foreach ($conditions as $condition)
            <option value="{{ $condition->id }}">{{ $condition->condition }}</option>
            @endforeach
        </select>
    </div>
    <div class="sell-form__group">
        <p>商品名と説明</p>
        <label for="name">商品名</label>
        <input type="text" name="name" value="{{ old('name') }}">
        <label for="description">商品の説明</label>
        <textarea name="description" cols="60" rows="6">{{old('description')}}</textarea>
    </div>
    <div class="sell-form__group">
        <p>販売価格</p>
        <label for="price"></label>
        <input type="text" name="price" placeholder="&yen;" value="{{old('price')}}">
    </div>
    <div class="sell-form__submit">
        <button type="submit">出品する</button>
    </div>
    </form>
</div>
</div>

@endsection