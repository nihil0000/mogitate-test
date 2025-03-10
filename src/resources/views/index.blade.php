@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="title__wrapper">
        <p class="title">商品一覧</p>
        <a href="{{ route('products.create') }}" class="btn__store-product">
            <button class="btn-add-product">+ 商品を追加</button>
        </a>
    </div>

    <section class="product-list-wrapper">
        <div class="search__wrapper">
            <input type="text" class="input-search">
            <button class="btn-search">検索</button>

            <p class="title-sort">価格順で表示</p>
            <select name="" id="" class="sort-price">
                <option value=""></option>
            </select>
        </div>


        <div class="product-list">
            @foreach ($products as $product)
            <div class="product__card">
                <a href="{{ route('products.show', $product->id) }}">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-img">
                </a>
                <div class="product__info">
                    <p class="product__name">{{ $product->name }}</p>
                    <p class="product__price">¥{{ $product->price }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection

