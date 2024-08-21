@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('header')
@component('components.menu3')
@endcomponent
@endsection


@section('content')
<div class="payment_complete">
    <p>お支払いが完了しました。</p>
    <p>お買い上げ誠にありがとうございます。</p>
</div>

@endsection