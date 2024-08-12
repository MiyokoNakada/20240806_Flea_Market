@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
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
    <div class="detail-inner">
        <div class="item-image">
            <img src="" alt="商品画像">
        </div>
        <div class="item-overview">
            <h2>商品名</h2>
            <p>ブランド名</p>
            <p>price</p>
            <div class="item-overview__button">
                <div class="favourite-count">
                    <i>favourite</i>
                </div>
                <div class="comment-count">
                    <i>comment</i>
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
                <p></p>
            </div>
            <div class="item-information">
                <h3>商品の情報</h3>
                <table>
                    <tr>
                        <th>カテゴリー</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>商品の状態</th>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="comment">
                <div class="comment-history">

                </div>
                <div class="comment-submit">
                    <label for="">商品へのコメント</label>
                    <textarea name="" id=""></textarea>
                    <button>コメントを送信する</button>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection