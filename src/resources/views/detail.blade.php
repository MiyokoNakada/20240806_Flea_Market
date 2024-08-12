@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('header')
@if (Auth::check())
@if (Auth::user()->hasVerifiedEmail())
@component('components.menu3')
@endcomponent
@else
@component('components.menu2') <!-- メール認証未完了 -->
@endcomponent
<div class="alert">
    メールアドレスの認証が完了していません。メールを確認し、認証を完了してください。
</div>
@endif
@else
@component('components.menu2') <!-- ログイン未 -->
@endcomponent
@endif
@endsection

@section('content')
<div class="detail">
    <div class="detail-inner-left">
        <div class="item-image">
            <img src="{{ asset('storage/image/' . $item->image) }}" alt="商品画像">
        </div>
    </div>
    <div class="detail-inner-right">
        <div class="item-overview">
            <h2>{{ $item->name }}</h2>
            <p><span class="item-overview_brand">ブランド名</span></p>
            <p><span class="item-overview_price">&yen;{{ $item->price }}(値段)</span></p>
            <div class="item-overview__button">
                <div class="favourite-count">
                    <i class="item-cards__favourite fa-regular fa-star fa-lg" data-user-id="{{ Auth::user()->id }}" data-item-id="{{ $item->id }}"></i>
                    <p>5</p>
                </div>
                <div class="comment-count">
                    <i class="fa-regular fa-comment fa-lg"></i>
                    <p>5</p>
                </div>
            </div>
        </div>
        <div class="item-contents">
            <div class="purchase-button">
                <a href="{{ url('/purchase/' . $item->id) }}">
                    <button>購入する</button>
                </a>
            </div>
            <div class="item-description">
                <h3>商品説明</h3>
                <p>{!! nl2br(htmlspecialchars($item->description)) !!}</p>
            </div>
            <div class="item-information">
                <h3>商品の情報</h3>
                <table class="item-information__table">
                    <tr>
                        <th>カテゴリー</th>
                        <td class="item-information__table_category">{{ $item->category->category_name }}</td>
                    </tr>
                    <tr>
                        <th>商品の状態</th>
                        <td>{{ $item->condition->condition }}</td>
                    </tr>
                </table>
            </div>
            <div class="comment">
                <div class="comment-history">
                    @foreach($item->comments as $comment)
                    @if($comment->user_id == $sellerId)
                    <div class="comment-seller">
                        <p>{{ $comment->user->name }}</p>
                        <p>{{ $comment->comment }}</p>
                    </div>
                    @else
                    <div class="comment-buyer">
                        <p>{{ $comment->user->name }}</p>
                        <p>{{ $comment->comment }}</p>
                    </div>
                    @endif
                    @endforeach
                </div>
                <div class="comment-submit">
                    <form action="{{ url('/item/' . $item->id . '/comment') }}" method="post">
                        @csrf
                        <label for="commen">商品へのコメント</label>
                        <textarea name="comment" id="comment" cols="40" rows="6">{{old('description')}}</textarea>
                        <button type="submit">コメントを送信する</button>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection