@extends('layouts.app')

@section('content')

<div class="shop-info__content">
    <form action="{{ route('shop.update', ['id' => $shop->id]) }}" method="post">
        @csrf
        @method('PATCH')
        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">店舗名</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__group__input">
                    <input type="text" name="shop_name" placeholder="店舗名" value="{{ old('shop_name', $shop->shop_name) }}">
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
                    <input type="text" name="description" placeholder="店舗情報" value="{{ old('description', $shop->description) }}">
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
                        <option value="{{ $area->id }}" @if(old('area_id', $shop->area_id) == $area->id) selected @endif>
                            {{ $area->area_name }}
                        </option>
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
                        <option value="{{ $genre->id }}" @if(old('genre_id', $shop->genre_id) == $genre->id) selected @endif>
                            {{ $genre->genre_name }}
                        </option>
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
    <form action="/shop/delete/{{ $shop->id }}" method="post">
        @csrf
        @method('DELETE')
        <input type="hidden" value="{{ $shop->id }}" name="shop_id">
        <button type="submit" class="form__button-delete" onclick="return confirm('本当に削除しますか？')">削除</button>

    </form>
    
</div>

@endsection