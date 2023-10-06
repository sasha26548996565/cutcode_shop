@extends('layouts.app')

@section('title', 'Заказ №' . $order->id)

@section('content')

    <!-- Breadcrumbs -->
    <ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
        <li><a href="{{ route('index') }}" class="text-body hover:text-pink text-xs">Главная</a></li>
        <li><a href="{{ route('order.index') }}" class="text-body hover:text-pink text-xs">Мои заказы</a></li>
        <li><span class="text-body text-xs">Заказ №{{ $order->id }}</span></li>
    </ul>

    <section>
        <!-- Section heading -->
        <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-6 mb-8">
            <h1 class="pb-4 md:pb-0 text-lg lg:text-[42px] font-black">Заказ №{{ $order->id }}</h1>
            <div class="px-6 py-3 rounded-lg bg-purple">Выполнено</div>
            <div class="px-6 py-3 rounded-lg bg-card">Дата заказа: {{ $order->created_at->format('Y.m.d') }}</div>
        </div>

        <!-- Message -->
        <div class="md:hidden py-3 px-6 rounded-lg bg-pink text-white">Таблицу можно пролистать вправо →</div>

        <!-- Adaptive table -->
        <div class="overflow-auto">
            <table class="min-w-full border-spacing-y-4 text-white text-sm text-left" style="border-collapse: separate">
                <thead class="text-xs uppercase">
                    <th scope="col" class="py-3 px-6">Товар</th>
                    <th scope="col" class="py-3 px-6">Цена</th>
                    <th scope="col" class="py-3 px-6">Количество</th>
                    <th scope="col" class="py-3 px-6">Сумма</th>
                </thead>
                <tbody>
                    @each('order.partials.product', $order->products, 'product')
                </tbody>
            </table>
        </div>

        <div class="flex flex-col-reverse md:flex-row md:items-center md:justify-between mt-8 gap-6">
            <div class="flex md:justify-end">
                <a href="{{ route('order.index') }}" class="btn btn-pink">←&nbsp; Вернуться назад</a>
            </div>
            <div class="text-[32px] font-black md:text-right">Итого: {{ $order->totalPrice }}₽</div>
        </div>

    </section>

@endsection
