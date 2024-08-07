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
        <p>会員登録ありがとうございます<br>
            <span class="email-verify">
                ご登録いただいたメールアドレス宛に登録確認用のご案内をお送りしました。<br>
                メールの内容を確認して、アカウントの登録を完了してください。
            </span>
        </p>
        <a href="/login">ログインする</a>
    </div>
</div>


@endsection