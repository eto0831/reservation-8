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
                <h3>{{ $reservation->shop->shop_name }}</h3>
                <p>Date: {{ $reservation->reserve_date }} </p>
                <p>Time:{{ \Carbon\Carbon::createFromFormat('H:i:s', $reservation->reserve_time)->format('H:i') }}</p>
                <p>Number: {{ $reservation->guest_count }}人</p>
                <img src="{{ $reservation->shop->image_url }}" alt="{{ $reservation->shop->name }}" class="shop__img">
            </li>
            @endforeach
        </ul>
    </div>
    <div class="favorites__wrap">
        <h2>お気に入り一覧</h2>
        <ul>
            @foreach($favorites as $favorite)
            <li>
                <h3>{{ $favorite->shop->shop_name }}</h3>
                <p>
                    <span> #{{ $favorite->shop->area->area_name}}</span>
                    <span>#{{ $favorite->shop->genre->genre_name}}</span>
                </p>
                <img src="{{ $favorite->shop->image_url }}" alt="{{ $favorite->shop->shop_name }}" class="shop__img">
            </li>
            @endforeach
        </ul>
    </div>
</div>

@endsection