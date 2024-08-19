@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('header')
@component('components.menu3')
@endcomponent
@endsection


@section('content')
<div class="comment_management">
    <h3>コメント管理</h3>

    <div class="comment_search">
        <h4>コメント検索</h4>
    </div>

    <div class="comment_list">
        <h4>コメント一覧</h4>
        <table class="comment_list__table">
            <tr>
                <th>商品名</th>
                <th>ユーザー名</th>
                <th>コメント</th>
                <th></th>
            </tr>
            @foreach($comments as $comment)
            <tr>
                <td>{{ $comment->item->name }}</td>
                <td>{{ $comment->user->name }}</td>
                <td>{{ $comment->comment }}</td>
                <td>削除</td>
            </tr>
            @endforeach

        </table>
    </div>
</div>


@endsection