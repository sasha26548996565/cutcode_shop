@extends('layouts.app')

@section('title', 'Оформление заказа')

@section('content')
    <!-- Breadcrumbs -->
    <ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
        <li><a href="{{ route('index') }}" class="text-body hover:text-pink text-xs">Главная</a></li>
        <li><a href="{{ route('cart.index') }}" class="text-body hover:text-pink text-xs">Корзина покупок</a></li>
        <li><span class="text-body text-xs">Оформление заказа</span></li>
    </ul>

    <section>
        <!-- Section heading -->
        <h1 class="mb-8 text-lg lg:text-[42px] font-black">Оформление заказа</h1>

        <form class="grid xl:grid-cols-3 items-start gap-6 2xl:gap-8 mt-12" method="POST" action="{{ route('order.store') }}">
            @csrf

            <!-- Contact information -->
            <div class="p-6 2xl:p-8 rounded-[20px] bg-card">
                <h3 class="mb-6 text-md 2xl:text-lg font-bold">Контактная информация</h3>
                <div class="space-y-3">
                    <input type="text" value="{{ old('name') }}"
                        class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                        placeholder="Имя" name="name" required>
                    <input type="text" name="lastName" value="{{ old('lastName') }}"
                        class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                        placeholder="Фамилия" required>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                        placeholder="Номер телефона" required>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                        placeholder="E-mail" required>
                    <div x-data="{ createAccount: false }">
                        <div class="py-3 text-body">Вы можете создать аккаунт после оформления заказа</div>
                        <div class="form-checkbox">
                            <input type="checkbox" id="checkout-create-account">
                            <label for="checkout-create-account" class="form-checkbox-label"
                                @click="createAccount = ! createAccount">Зарегистрировать аккаунт</label>
                        </div>
                        <div x-show="createAccount" x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0" class="mt-4 space-y-3">
                            <input type="password" name="password"
                                class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                                placeholder="Придумайте пароль">
                            <input type="password" name="password_confirmation"
                                class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                                placeholder="Повторите пароль">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping & Payment -->
            <div class="space-y-6 2xl:space-y-8">

                <!-- Shipping-->
                <div class="p-6 2xl:p-8 rounded-[20px] bg-card">
                    <h3 class="mb-6 text-md 2xl:text-lg font-bold">Способ доставки</h3>
                    <div class="space-y-5">
                        <div class="form-radio">
                            <input type="radio" name="pickup" id="delivery-method-pickup">
                            <label for="delivery-method-pickup" class="form-radio-label">Самовывоз</label>
                        </div>
                        <div class="space-y-3">
                            <div class="form-radio">
                                <input type="radio" name="pickup" id="delivery-method-address" checked>
                                <label for="delivery-method-address" class="form-radio-label">Адресная доставка</label>
                            </div>
                            <input type="text" name="city"
                                class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                                placeholder="Город" required>
                            <input type="text" name="address"
                                class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                                placeholder="Адрес" required>
                        </div>
                    </div>
                </div>

                <!-- Payment-->
                <div class="p-6 2xl:p-8 rounded-[20px] bg-card">
                    <h3 class="mb-6 text-md 2xl:text-lg font-bold">Метод оплаты</h3>
                    <div class="space-y-5">
                        <div class="form-radio">
                            <input type="radio" name="paymentMethod" value="Наличными" id="payment-method-1" checked>
                            <label for="payment-method-1" class="form-radio-label">Наличными</label>
                        </div>
                        <div class="form-radio">
                            <input type="radio" name="paymentMethod" value="Кредитной картой" id="payment-method-2">
                            <label for="payment-method-2" class="form-radio-label">Кредитной картой</label>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Checkout -->
            <div class="p-6 2xl:p-8 rounded-[20px] bg-card">
                <h3 class="mb-6 text-md 2xl:text-lg font-bold">Заказ</h3>
                <table class="w-full border-spacing-y-3 text-body text-xxs text-left" style="border-collapse: separate">
                    <thead class="text-[12px] text-body uppercase">
                        <th scope="col" class="pb-2 border-b border-body/60">Товар</th>
                        <th scope="col" class="px-2 pb-2 border-b border-body/60">К-во</th>
                        <th scope="col" class="px-2 pb-2 border-b border-body/60">Сумма</th>
                    </thead>
                    <tbody>
                        @foreach ($cart as $cartItem)
                        <tr>
                            <td scope="row" class="pb-3 border-b border-body/10">
                                <h4 class="font-bold"><a href="{{ route('product.show', $cartItem->product) }}"
                                        class="inline-block text-white hover:text-pink break-words pr-3">{{ $cartItem->product->title }}
                                        Snow</a></h4>
                                <ul>
                                    @foreach ($cartItem->product->optionValues as $optionValue)
                                        @if (in_array($optionValue->id, $cartItem->optionValueIds))
                                            <li class="text-body">{{ $optionValue->option->title }}: {{ $optionValue->title }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-2 pb-3 border-b border-body/20 whitespace-nowrap">{{ $cartItem->quantity }}.</td>
                            <td class="px-2 pb-3 border-b border-body/20 whitespace-nowrap">{{ $cartItem->price }} ₽</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-xs font-semibold text-right">Всего: {{ getTotalPriceInCart() }} ₽</div>

                <div class="mt-8 space-y-8">
                    <!-- Promocode -->
                    @include('checkout.partials.promocode')

                    <!-- Summary -->
                    <table class="w-full text-left">
                        <tbody>
                            <tr>
                                <th scope="row" class="text-md 2xl:text-lg font-black">Итого:</th>
                                <td class="text-md 2xl:text-lg font-black">{{ getTotalPriceInCart() }} ₽</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Process to checkout -->
                    <button type="submit" class="w-full btn btn-pink">Оформить заказ</button>
                </div>
            </div>

        </form>
    </section>
@endsection
