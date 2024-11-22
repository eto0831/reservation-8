@extends('layouts.app')

@section('content')

<div class="shop-info__content">
    <form action="/shop/create" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">店舗名</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__group__input">
                    <input type="text" name="shop_name" placeholder="店舗名" value="{{ old('shop_name') }}">
                </div>
                <div class="form__error">
                    @error('shop_name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">店舗情報</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__group__input">
                    <input type="text" name="description" placeholder="店舗情報" value="{{ old('description') }}">
                </div>
                <div class="form__error">
                    @error('description')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">Area</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="select__item-wrapper">
                    <select class="select__item-select" name="area_id">
                        <option value="" disabled>Area</option>
                        @foreach($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form__error">
                    @error('description')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">Genre</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="select__item-wrapper">
                    <select class="select__item-select" name="genre_id">
                        <option value="" disabled>Genre</option>
                        @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form__error">
                    @error('description')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">作成</button>
        </div>
    </form>
</div>

@endsection