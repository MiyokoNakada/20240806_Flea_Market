@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('header')
@component('components.menu3')
@endcomponent
@endsection


@section('content')

<div class="admin">
    <div class="admin_inner">
        <h2>管理者用画面</h2>
        <div class="message">
            {{ session('message') }}
        </div>

        <div class="email">
            <h3>メール送信</h3>
            <form class="email__form" action="/admin/send_email" method="POST">
                @csrf
                <div class="email__form-item">
                    <input type="email" name="email_address" placeholder="メールアドレス" value="{{ old('email_address') }}">
                    <span class="error">@error('email_address'){{ $message }}@enderror</span>
                </div>
                <div class="email__form-item">
                    <input type="text" name="title" placeholder="タイトル" value="{{ old('title') }}">
                    <span class="error">@error('title'){{ $message }}@enderror</span>
                </div>
                <div class="email__form-item">
                    <textarea name="body" rows="5" cols="70" placeholder="本文"></textarea>
                    <span class="error">@error('body'){{ $message }}@enderror</span>
                </div>
                <div class="email__form-item">
                    <button type="submit">送信</button>
                </div>
            </form>
        </div>

        <div class="admin_user">
            <h3>ユーザー管理</h3>
            <a href="/admin/user">ユーザー管理はこちらから</a>
        </div>
        <div class="admin_comment">
            <h3>コメント管理</h3>
            <a href="/admin/comment">コメント管理はこちらから</a>
        </div>
    </div>
</div>

@endsection