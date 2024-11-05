@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage/index.css') }}">
@endsection

@section('content')
<div class="attendance__alert">
    // メッセージ機能
</div>

<div class="mypage__content">
    <div class="reservations__wrap">
        <h2>予約一覧</h2>
        <ul>
            @foreach ($reservations as $reservation)
            <li>
                <h2>{{ $reservation->shop_name }}</h2>
                <p>ジャンル: {{ $reservation->genre->genre_name }}</p>
                <p>エリア: {{ $reservation->area->area_name }}</p>
                <p>説明: {{ $reservation->description }}</p>
                <img src="{{ asset($reservation->image_url) }}" alt="{{ $reservation->shop_name }}" class="shop__img">
            </li>
            @endforeach
        </ul>
    </div>
    </div>
    <div class="favorites__wrap">
        <h2>お気に入り一覧</h2>
        
    </div>
</div>

@endsection