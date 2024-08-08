@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('header')
@component('components.menu1')
@endcomponent
@endsection


@section('content')

<div class="auth">
    <div class="auth-inner">
        <h2>ログイン</h2>

        <div class="alert">
            {{ session('access-alert') }}
        </div>

        <form class="auth-form" action="/login" method="post">
            @csrf
            <div class="auth-form__item">
                <label for="email">メールアドレス</label>
                <input type="email" name="email" value="{{ old('email') }}">
                <div class="error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>

            </div>
            <div class="auth-form__item">
                <label for="password">パスワード</label>
                <input type="password" name="password" value="{{ old('password') }}">
                <div class="error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="auth-form__submit">
                <button class="auth-form__btn" type="submit">ログインする</button>
            </div>
        </form>
        <div class="auth-form__link">
            <a href="/register">会員登録はこちら</a>
        </div>
    </div>
</div>


@endsection