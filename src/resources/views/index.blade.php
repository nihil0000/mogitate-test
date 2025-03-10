@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="title__wrapper">
        <p class="title">商品一覧</p>
        <a href="{{ route('products.create') }}" class="btn__store-product">
            <button class="btn__add-product">+ 商品を追加</button>
        </a>
    </div>

    <section class="product-list-wrapper">
        <!-- Search form -->
        <form class="search__form" action="{{ route('products.search') }}" method="get">
            <!-- Search by name -->
            <input type="text" class="input-search" name="name" value="{{ request('name') }}" placeholder="商品名で検索">
            <button type="submit" class="btn-search">検索</button>

            <!-- Sort by price -->
            <div class="sort__group">
                <p class="sort-title">価格順で表示</p>

                <div class="custom-select">
                    <select name="sort_price" id="" class="sort-price" onchange="this.form.submit()">
                        <option value="">価格で並び替え</option>
                        <option value="asc" {{ request('sort_price') == 'asc' ? 'selected' : '' }}>安い順に表示</option>
                        <option value="desc" {{ request('sort_price') == 'desc' ? 'selected' : '' }}>高い順に表示</option>
                    </select>
                </div>

                @if(request('sort_price'))
                <div class="selected-sort">
                    <span>{{ request('sort_price') == 'asc' ? '安い順に表示' : '高い順に表示' }}</span>
                    <a href="{{ route('products.index', ['query' => request('query')]) }}" class="clear-sort">×</a>
                </div>
                @endif
            </div>
        </form>


        <div class="product-list">
            <div class="product__cards">
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

            {{ $products->links('vendor.pagination.pagination') }}
        </div>
    </section>

</div>
@endsection

