@extends('layout.app')

@section('content')

<p>
    <font size="+2">{{ $emails['title'] }}</font>
</p>
<p>{!! nl2br(e($emails['body'])) !!}</p>

@endsection