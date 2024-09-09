@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('header')
@component('components.menu3')
@endcomponent
@endsection


@section('content')
<div class="user_management">
    <h3>ユーザー管理</h3>

    <div class="user_search">
        <h4>ユーザー検索</h4>
        <form action="/admin/user/search" method="post">
            @csrf
            <input type="text" name="keyword" placeholder="名前もしくはユーザー名" value="{{ request('keyword') }}">
            <button type="submit">検索</button>
        </form>
        <div class="error">
            @error('keyword')
            {{ $message }}
            @enderror
        </div>
    </div>

    <div class="user_list">
        <h4>ユーザー一覧</h4>
        <table class="user_list__table">
            <tr>
                <th>名前</th>
                <th>メールアドレス</th>
                <th></th>
            </tr>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form action="/admin/user/delete" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('このユーザーを削除してもよろしいですか？')">削除</button>
                        <input type="hidden" name="id" value="{{ $user->id }}">
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>


@endsection