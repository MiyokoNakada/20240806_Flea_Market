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

<div class="profile">
    <div class="profile-inner">
        <h2>プロフィール設定</h2>

        <form class="profile-form" action="/mypage/profile" method="post" enctype="multipart/form-data">
            @csrf
            <div class=" profile-form__image">
                <input type="file" id="upload" name="profile_image" accept="image/*" onchange="previewImage(event)">
                <img id="imagePreview" class="profile-form__image-preview" src="" alt="">
                <label for="upload" class="profile-form__image-label">画像を選択する</label>
            </div>
            <div class="profile-form__item">
                <label for="name">ユーザー名</label>
                <input type="text" name="name" value="{{ old('name') }}">
                <div class="error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="profile-form__item">
                <label for="postal_code">郵便番号</label>
                <input type="text" name="postal_code" value="{{ old('postal_code') }}">
                <div class="error">
                    @error('postal_code')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="profile-form__item">
                <label for="address">住所</label>
                <input type="text" name="address" value="{{ old('address') }}">
                <div class="error">
                    @error('address')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="profile-form__item">
                <label for="building">建物名</label>
                <input type="text" name="building" value="{{ old('building') }}">
                <div class="error">
                    @error('building')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="profile-form__submit">
                <button class="profile-form__btn" type="submit">更新する</button>
            </div>
        </form>

    </div>
</div>


@endsection