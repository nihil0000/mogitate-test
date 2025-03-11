@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<section class="register-container">
    <h1 class="title">商品登録</h1>

    <form class="form" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <!-- name -->
        <div class="product__group">
            <p class="product__item">商品名</p>
            <span class="required-text">必須</span>
            <input type="text" class="product__input" name="name" placeholder="商品名を入力" value="{{ old('name') }}">

            <!-- validation message -->
            @error('name')
                <p class="form__error-msg">{{ $message }}</p>
            @enderror
        </div>

        <!-- price -->
        <div class="product__group">
            <p class="product__item">値段</p>
            <span class="required-text">必須</span>
            <input type="text" class="product__input" name="price" placeholder="値段を入力" value="{{ old('price') }}">

            <!-- validation message -->
            @error('price')
                <p class="form__error-msg">{{ $message }}</p>
            @enderror
        </div>

        <!-- image -->
        <div class="product__group">
            <p class="product__item">商品画像</p>
            <span class="required-text">必須</span>
            <input type="file" class="product__img-input" name="image">

            <!-- validation message -->
            @error('image')
                <p class="form__error-msg">{{ $message }}</p>
            @enderror
        </div>

        <!-- season -->
        <div class="product__group">
            <p class="product__item">季節</p>
            <span class="required-text">必須</span>
            <span class="multiple-select-text">複数選択可</span>

            <div class="select-group">
                @foreach ($seasons as $season)
                    <label for="season-{{ $season->id }}" class="season-select__label">
                    <input type="checkbox" id="season-{{ $season->id }}" name="seasons[]" value="{{ $season->id }}" class="season-select__checkbox" {{ is_array(old('seasons')) && in_array($season->id, old('seasons')) ? 'checked' : '' }}>
                    <span class="custom-checkbox"></span>
                    {{ $season->name }}
                    </label>
                @endforeach
            </div>

            <!-- validation message -->
            @error('seasons')
                <p class="form__error-msg">{{ $message }}</p>
            @enderror
        </div>

        <!-- description -->
        <div class="product__description">
            <p class="product__item">商品説明</p>
            <span class="required-text">必須</span>
            <textarea name="description" class="description__textarea" placeholder="商品の説明を入力">{{ old('description') }}</textarea>

            <!-- validation message -->
            @error('description')
                <p class="form__error-msg">{{ $message }}</p>
            @enderror
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
