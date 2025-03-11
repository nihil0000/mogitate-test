@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<section class="form__container">
    <!-- breadcrumb list -->
    <div class="breadcrumb">
        <a href="{{ route('products.index') }}" class="breadcrumb-link">商品一覧</a>
        <span> &gt; {{ $product->name }}</span>
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
                    <input type="text" name="name" class="product__input" value="{{ old('name') }}" placeholder="商品名を入力">

                    <!-- validation message -->
                    @error('name')
                        <p class="form__error-msg">{{ $message }}</p>
                    @enderror
                </div>

                <!-- price -->
                <div class="product-info__group">
                    <p class="product-info__item">値段</p>
                    <input type="text" name="price" class="product__input" value="{{ old('price') }}" placeholder="値段を入力">

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
                        <input type="checkbox" id="season-{{ $season->id }}" name="seasons[]" value="{{ $season->id }}" class="season-select__checkbox" {{ (is_array(old('seasons')) && in_array($season->id, old('seasons'))) || $product->seasons->contains('name', $season->name) ? 'checked' : '' }}>
                        <span class="custom-checkbox"></span>
                        {{ $season->name }}
                        </label>
                    @endforeach

                    <!-- validation message -->
                    @error('seasons')
                        <p class="form__error-msg">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- description -->
        <div class="product-description">
            <p class="product-info__item">商品説明</p>
            <textarea name="description" class="description-textarea" placeholder="商品の説明を入力">{{ old('description') }}</textarea>

            <!-- validation message -->
            @error('description')
                <p class="form__error-msg">{{ $message }}</p>
            @enderror
        </div>

        <div class="button__wrapper">
            <!-- back button -->
            <a href="{{ route('products.index') }}" class="btn-back">戻る</a>

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
