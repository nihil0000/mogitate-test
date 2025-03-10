@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<section class="form__container">
    <!-- breadcrumb list -->
    <div class="breadcrumb">
        <a href="{{ route('products.index') }}" class="breadcrumb-link">商品一覧</a>
        <span class="name"> &gt; {{ $product->name }}</span>
    </div>

    <!-- product details (image, name, price, season, description -->
    <form class="product-details__form" action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <!-- top (image, name, price, season) -->
        <div class="product-details__top">
            <!-- image -->
            <div class="product-img__wrapper">
                <input type="file" name="image" class="file-input" accept="image/*" value="{{ old('image') }}">

                <!-- validation message -->
                @error('image')
                    <p class="form__error-msg">{{ $message }}</p>
                @enderror
            </div>

            <!-- name, price, season -->
            <div class="product-info">
                <!-- name -->
                <div class="product-info__group">
                    <p class="product-info__item">商品名</p>
                    <input type="text" name="name" class="product-name__input" value="{{ old('name') }}" placeholder="{{ $product->name }}">

                    <!-- validation message -->
                    @error('name')
                        <p class="form__error-msg">{{ $message }}</p>
                    @enderror
                </div>

                <!-- price -->
                <div class="product-info__group">
                    <p class="product-info__item">値段</p>
                    <input type="text" name="price" class="product-price__input" value="{{ old('price') }}" placeholder="{{ $product->price }}">

                    <!-- validation message -->
                    @error('price')
                        <p class="form__error-msg">{{ $message }}</p>
                    @enderror
                </div>

                <!-- season -->
                <div class="product-info__group">
                    <p class="product-info__item">季節</p>
                    @foreach ($seasons as $season)
                        <label for="season-{{ $season->id }}" class="season-select__label">
                        <input type="checkbox" id="season-{{ $season->id }}" name="seasons[]" value="{{ $season->id }}" class="season-select__checkbox" {{ $product->seasons->contains('name', $season->name) ? 'checked' : '' }}>
                        <span class="custom-checkbox"></span>
                        {{ $season->name }}
                        </label>
                    @endforeach

                    <!-- validation message -->
                    @error('season')
                        <p class="form__error-msg">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- description -->
        <div class="product-description">
            <p class="product-info__item">商品説明</p>
            <textarea name="description" class="description__input" placeholder="{{ $product->description }}">{{ old('description') }}</textarea>

            <!-- validation message -->
            @error('description')
                <p class="form__error-msg">{{ $message }}</p>
            @enderror
        </div>

        <div class="button__wrapper">
            <!-- back button -->
            <a href="{{ route('products.index') }}" class="btn-back">
                <button type="button" class="btn-back">戻る</button>
            </a>

            <!-- save button -->
            <button type="submit" class="btn-save">変更を保存</button>
        </div>
    </form>

    <!-- delete button (trash icon) -->
    <form action="{{ route('products.destroy', $product->id) }}" method="post" class="delete-form">
        @csrf
        @method('delete')
        <button type="submit" class="btn-delete">
            <img src="{{ asset('images/icons/trash.svg') }}" alt="削除">
        </button>
    </form>
</section>
@endsection
