@extends('layouts.app')

@section('title', 'Каталог')

@section('content')
    <ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
        <li><a href="{{ route('index') }}" class="text-body hover:text-pink text-xs">Главная</a></li>
        <li><a href="{{ route('catalog.index') }}" class="text-body hover:text-pink text-xs">Каталог</a></li>
        @if ($category->title)
            <li><span class="text-body text-xs">{{ $category->title }}</span></li>
        @endif
    </ul>

    <section>
        <!-- Section heading -->
        <h2 class="text-lg lg:text-[42px] font-black">Категории</h2>

        <!-- Categories -->
        <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-3 sm:gap-4 md:gap-5 mt-8">
            @each('catalog.partials.category', $categories, 'category')
        </div>
    </section>

    <section class="mt-16 lg:mt-24">
        <!-- Section heading -->
        <h2 class="text-lg lg:text-[42px] font-black">Каталог товаров</h2>

        <div class="flex flex-col lg:flex-row gap-12 lg:gap-6 2xl:gap-8 mt-8">

            <!-- Filters -->
           @include('catalog.partials.filters.show', compact('brands'))

            <div class="basis-auto xl:basis-3/4">
                <!-- Sort by -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                    <div class="flex items-center gap-4">
                        <div class="text-body text-xxs sm:text-xs">Найдено: {{ $products->total() }} товаров</div>
                    </div>
                    @include('catalog.partials.sort.show', compact('category'))
                </div>

                <!-- Products list -->
                <div class="products grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-x-6 2xl:gap-x-8 gap-y-8 lg:gap-y-10 2xl:gap-y-12">
                    @each('catalog.partials.product', $products, 'product')
                </div>

                <!-- Page pagination -->
                <div class="mt-12">
                    {{ $products->withQueryString()->links('catalog.partials.pagination') }}
                </div>
            </div>
        </div>

    </section>
@endsection
