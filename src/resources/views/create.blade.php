@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<section class="register-container">
    <p class="title">商品一覧</p>

    <form class="form" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <!-- name -->
        <div class="product__group">
            <p class="product__item">商品名</p>
            <input type="text" class="product__input" name="name" placeholder="商品名を入力">
        </div>

        <!-- price -->
        <div class="product__group">
            <p class="product__item">値段</p>
            <input type="text" class="product__input" name="price" placeholder="値段を入力">
        </div>

        <!-- image -->
        <div class="product__group">
            <p class="product__item">商品画像</p>
            <input type="file" class="product__input" name="image">
        </div>

        <!-- season -->
        <div class="product__group">
            <p class="product__item">季節</p>

            @foreach ($seasons as $season)
                <label for="season-{{ $season->id }}" class="season-select__label">
                <input type="checkbox" id="season-{{ $season->id }}" name="seasons[]" value="{{ $season->id }}" class="season-select__checkbox">
                <span class="custom-checkbox"></span>
                {{ $season->name }}
                </label>
            @endforeach
        </div>

        <!-- description -->
        <div class="product__description">
            <p class="product__item">商品説明</p>
            <textarea name="description" class="description__input"></textarea>
        </div>

        <!-- form button -->
        <div class="button__wrapper">
            <!-- back button -->
            <a href="{{ route('products.index') }}" class="btn-back">
                <button type="button" class="btn-back">戻る</button>
            </a>

            <!-- save button -->
            <button type="submit" class="btn-save">登録</button>
        </div>
    </form>
</section>
@endsection
