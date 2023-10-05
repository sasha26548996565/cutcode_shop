@extends('layouts.app')

@section('title', 'Каталог')

@section('content')
    <ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
        <li><a href="{{ route('index') }}" class="text-body hover:text-pink text-xs">Главная</a></li>
        <li><a class="text-body hover:text-pink text-xs">Избранное</a></li>
    </ul>

    <section class="mt-16 lg:mt-24">
        <!-- Section heading -->
        <h2 class="text-lg lg:text-[42px] font-black">Избранное</h2>

        <div class="flex flex-col lg:flex-row gap-12 lg:gap-6 2xl:gap-8 mt-8">

            <div class="basis-auto xl:basis-3/4">
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
