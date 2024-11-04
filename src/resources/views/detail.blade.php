@extends('layouts.app')

@use App\Models\Favorite;

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="attendance__alert">
    // メッセージ機能
</div>

<div class="attendance__content">
    <div class="detail__wrap">
        <h1>店舗詳細</h1>
        <ul>
            <li>
                <h2>{{ $shop->shop_name }}</h2>
                <p>ジャンル: {{ $shop->genre->genre_name }}</p>
                <p>エリア: {{ $shop->area->area_name }}</p>
                <p>説明: {{ $shop->description }}</p>
                <img src="{{ asset($shop->image_url) }}" alt="{{ $shop->shop_name }}" class="shop__img">
                @if ($shop->isFavorited)
                <form action="/not-favorite" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                    <button type="submit">お気に入りから外す</button>
                </form>
                @else
                <form action="/favorite" method="POST">
                    @csrf
                    <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                    <button type="submit">お気に入り</button>
                </form>
                @endif
            </li>
        </ul>
    </div>
    <div class="reservation__form">
        <h1>予約</h1>
    </div>
</div>
@endsection