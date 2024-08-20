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
                <h4>商品画像</h4>
                <div class="error">
                    @error('image')
                    {{ $message }}
                    @enderror
                </div>
                <div class="sell-form__image">
                    <input type="file" id="upload" name="image" accept="image/*" onchange="previewImage(event)">
                    <label for="upload" class="sell-form__image-label">画像を選択する</label>
                    <img id="imagePreview" class="sell-form__image-preview" src="" alt="" style="display: none;">
                </div>
            </div>

            <div class="sell-form__group">
                <h3>商品の詳細</h3>
                <div class="sell-form__group-category">
                    <h4>カテゴリー</h4>
                    <div class="error">
                        @error('category')
                        {{ $message }}
                        @enderror
                    </div>
                    @foreach ($categories as $category)
                    <input class="sell-form__checkbox" type="checkbox" name="categories[]" value="{{ $category->id }}">
                    <label for="category-{{ $category->id }}">{{ $category->category_name }}</label>
                    @endforeach
                </div>
                <h4>商品の状態</h4>
                <div class="error">
                    @error('condition_id')
                    {{ $message }}
                    @enderror
                </div>
                <select name="condition_id">
                    <option value="{{ old('condition_id')}}"></option>
                    @foreach ($conditions as $condition)
                    <option value="{{ $condition->id }}">{{ $condition->condition }}</option>
                    @endforeach
                </select>
            </div>

            <div class="sell-form__group">
                <h3>商品名と説明</h3>
                <h4>商品名</h4>
                <div class="error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
                <input type="text" name="name" value="{{ old('name') }}">

                <h4>ブランド名</h4>
                <div class="error">
                    @error('brand')
                    {{ $message }}
                    @enderror
                </div>
                <input type="text" name="brand" value="{{ old('brand') }}">

                <h4>商品の説明</h4>
                <div class="error">
                    @error('description')
                    {{ $message }}
                    @enderror
                </div>
                <textarea name="description" cols="60" rows="6">{{old('description')}}</textarea>
            </div>

            <div class="sell-form__group">
                <h3>販売価格</h3>
                <h4>販売価格</h4>
                <div class="error">
                    @error('price')
                    {{ $message }}
                    @enderror
                </div>
                <input type="text" name="price" placeholder="&yen;" value="{{old('price')}}">
            </div>
            
            <div class="sell-form__submit">
                <button type="submit">出品する</button>
            </div>
        </form>
    </div>
</div>

@endsection