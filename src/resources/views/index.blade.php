@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="attendance__alert">
    // メッセージ機能
</div>

<div class="attendance__content">
    <h1>店舗一覧</h1>
    <ul>
        @foreach ($shops as $shop)
            <li>
                <h2>{{ $shop->shop_name }}</h2>
                <p>ジャンル: {{ $shop->genre->name }}</p>
                <p>エリア: {{ $shop->area->name }}</p>
                <p>説明: {{ $shop->description }}</p>
                <img src="{{ asset($shop->image_url) }}" alt="{{ $shop->shop_name }}">
            </li>
        @endforeach
    </ul>
</div>
@endsection