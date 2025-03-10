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
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-img">
                <input type="file" name="image" class="file-input" accept="image/*">
            </div>

            <!-- name, price, season -->
            <div class="product-info">
                <!-- Name -->
                <div class="product-info__group">
                    <p class="product-info__item">商品名</p>
                    <input type="text" name="name" class="product-name__input" value="{{ $product->name }}" placeholder="{{ $product->name }}">
                </div>

                <!-- price -->
                <div class="product-info__group">
                    <p class="product-info__item">値段</p>
                    <input type="text" name="price" class="product-price__input" value="{{ $product->price }}" placeholder="{{ $product->price }}">
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
                </div>
            </div>
        </div>

        <!-- description -->
        <div class="product-description">
            <p class="product-info__item">商品説明</p>
            <textarea name="description" class="description__input" placeholder="{{ $product->description }}">{{ $product->description }}</textarea>
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
