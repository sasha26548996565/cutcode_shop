@extends('layouts.app')

@section('title', $product->title)

@section('content')
    <!-- Breadcrumbs -->
    <ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
        <li><a href="{{ route('index') }}" class="text-body hover:text-pink text-xs">Главная</a></li>
        <li><a href="{{ route('catalog.index') }}" class="text-body hover:text-pink text-xs">Каталог</a></li>
        <li><a href="catalog.html" class="text-body hover:text-pink text-xs">CATEGORIES</a></li>
        <li><span class="text-body text-xs">{{ $product->title }}</span></li>
    </ul>

    <!-- Main product -->
    <section class="flex flex-col lg:flex-row gap-10 xl:gap-14 2xl:gap-20 mt-12">

        <div class="basis-full lg:basis-2/5 xl:basis-2/4">
            <div class="overflow-hidden h-auto max-h-[620px] lg:h-[480px] xl:h-[620px] rounded-3xl">
                <img src="{{ $product->makeThumbnail('600x600') }}" class="object-cover w-full h-full" alt="{{ $product->title }}">
            </div>
        </div>

        <div class="basis-full lg:basis-3/5 xl:basis-2/4">
            <div class="grow flex flex-col lg:py-8">
                <h1 class="text-lg md:text-xl xl:text-[42px] font-black">{{ $product->title }}</h1>
                <ul class="flex items-center gap-2 mt-4">
                    <li class="text-[#FFC107]">
                        <svg class="w-4 md:w-6 h-4 md:h-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 52 52">
                            <path
                                d="M51.864 19.948a2.758 2.758 0 0 0-2.379-1.9l-15.008-1.363-5.935-13.89a2.765 2.765 0 0 0-5.083.002l-5.935 13.888-15.011 1.363a2.763 2.763 0 0 0-2.377 1.9 2.76 2.76 0 0 0 .808 2.936l11.345 9.95L8.944 47.57a2.763 2.763 0 0 0 1.074 2.853 2.753 2.753 0 0 0 3.036.133L26 42.818l12.942 7.738a2.765 2.765 0 0 0 4.113-2.986l-3.346-14.736 11.345-9.948a2.765 2.765 0 0 0 .81-2.938Z" />
                        </svg>
                    </li>
                    <li class="text-[#FFC107]">
                        <svg class="w-4 md:w-6 h-4 md:h-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 52 52">
                            <path
                                d="M51.864 19.948a2.758 2.758 0 0 0-2.379-1.9l-15.008-1.363-5.935-13.89a2.765 2.765 0 0 0-5.083.002l-5.935 13.888-15.011 1.363a2.763 2.763 0 0 0-2.377 1.9 2.76 2.76 0 0 0 .808 2.936l11.345 9.95L8.944 47.57a2.763 2.763 0 0 0 1.074 2.853 2.753 2.753 0 0 0 3.036.133L26 42.818l12.942 7.738a2.765 2.765 0 0 0 4.113-2.986l-3.346-14.736 11.345-9.948a2.765 2.765 0 0 0 .81-2.938Z" />
                        </svg>
                    </li>
                    <li class="text-[#FFC107]">
                        <svg class="w-4 md:w-6 h-4 md:h-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 52 52">
                            <path
                                d="M51.864 19.948a2.758 2.758 0 0 0-2.379-1.9l-15.008-1.363-5.935-13.89a2.765 2.765 0 0 0-5.083.002l-5.935 13.888-15.011 1.363a2.763 2.763 0 0 0-2.377 1.9 2.76 2.76 0 0 0 .808 2.936l11.345 9.95L8.944 47.57a2.763 2.763 0 0 0 1.074 2.853 2.753 2.753 0 0 0 3.036.133L26 42.818l12.942 7.738a2.765 2.765 0 0 0 4.113-2.986l-3.346-14.736 11.345-9.948a2.765 2.765 0 0 0 .81-2.938Z" />
                        </svg>
                    </li>
                    <li class="text-[#FFC107]">
                        <svg class="w-4 md:w-6 h-4 md:h-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 52 52">
                            <path
                                d="M51.864 19.948a2.758 2.758 0 0 0-2.379-1.9l-15.008-1.363-5.935-13.89a2.765 2.765 0 0 0-5.083.002l-5.935 13.888-15.011 1.363a2.763 2.763 0 0 0-2.377 1.9 2.76 2.76 0 0 0 .808 2.936l11.345 9.95L8.944 47.57a2.763 2.763 0 0 0 1.074 2.853 2.753 2.753 0 0 0 3.036.133L26 42.818l12.942 7.738a2.765 2.765 0 0 0 4.113-2.986l-3.346-14.736 11.345-9.948a2.765 2.765 0 0 0 .81-2.938Z" />
                        </svg>
                    </li>
                    <li class="text-body">
                        <svg class="w-4 md:w-6 h-4 md:h-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 52 52">
                            <path
                                d="M51.864 19.948a2.758 2.758 0 0 0-2.379-1.9l-15.008-1.363-5.935-13.89a2.765 2.765 0 0 0-5.083.002l-5.935 13.888-15.011 1.363a2.763 2.763 0 0 0-2.377 1.9 2.76 2.76 0 0 0 .808 2.936l11.345 9.95L8.944 47.57a2.763 2.763 0 0 0 1.074 2.853 2.753 2.753 0 0 0 3.036.133L26 42.818l12.942 7.738a2.765 2.765 0 0 0 4.113-2.986l-3.346-14.736 11.345-9.948a2.765 2.765 0 0 0 .81-2.938Z" />
                        </svg>
                    </li>
                </ul>
                <div class="flex items-baseline gap-4 mt-4">
                    <div class="text-pink text-lg md:text-xl font-black">{{ $product->price }} ₽</div>
                    <div class="text-body text-md md:text-lg font-bold line-through"></div>
                </div>
                <ul class="sm:max-w-[360px] space-y-2 mt-8">
                    @foreach ($product->properties as $property)
                        <li class="flex justify-between text-body">
                            <strong class="text-white">{{ $property->title }}:</strong> {{ $property->pivot->value }}
                        </li>
                    @endforeach
                </ul>

                <!-- Add to cart -->
                <form class="space-y-8 mt-8">
                    <div class="grid grid-cols-2 md:grid-cols-3 2xl:grid-cols-4 gap-4">
                        @foreach ($options as $option => $values)
                            <div class="flex flex-col gap-2">
                                <label for="filter-item-1" class="cursor-pointer text-body text-xxs font-medium">{{ $option }}</label>
                                <select id="filter-item-1"
                                    class="form-select w-full h-12 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition">
                                    @foreach ($values as $value)
                                        <option value="{{ $value->id }}" class="text-dark">
                                            <a href="{{ route('product.show', $product) }}">
                                                {{ $value->title }}
                                            </a>
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>
                    @include('catalog.partials.cart')
                </form>
            </div>
        </div>

    </section>

    <!-- Description -->
    <section class="mt-12 xl:mt-16 pt-8 lg:pt-12 border-t border-white/10">
        <h2 class="mb-12 text-lg lg:text-[42px] font-black">Описание</h2>
        <article class="text-xs md:text-sm">
            <h5 class="mb-4 text-md lg:text-lg font-black">{{ $product->brand->title }}</h5>
            <ul class="mb-12 list-outside space-y-3">
                <li>{{ $product->description }}</li>
            </ul>
        </article>
    </section>

    <!-- Watched products  -->
    <section class="mt-16 xl:mt-24">
        <h2 class="mb-12 text-lg lg:text-[42px] font-black">Просмотренные товары</h2>
        <!-- Products list -->
        <div class="products grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-x-8 gap-y-8 lg:gap-y-10 2xl:gap-y-12">
            @each('catalog.partials.product', $alsoProducts, 'product')
        </div>
    </section>

@endsection
