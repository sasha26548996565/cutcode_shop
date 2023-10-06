@extends('layouts.app')

@section('title', 'Заказ')

@section('content')
    <!-- Breadcrumbs -->
    <ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
        <li><a href="{{ route('index') }}" class="text-body hover:text-pink text-xs">Главная</a></li>
        <li><span class="text-body text-xs">Мои заказы</span></li>
    </ul>

    <section>
        <!-- Section heading -->
        <h1 class="mb-8 text-lg lg:text-[42px] font-black">Мои заказы</h1>

        <!-- Orders list -->
        <div class="w-full space-y-4 text-white text-sm text-left">

            @each('order.partials.order', $orders, 'order')

        </div>
    </section>
@endsection
