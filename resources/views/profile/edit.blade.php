@extends('layouts.app')

@section('title', 'Редактировать профиль')

@section('content')
    <section>
        <!-- Section heading -->
        <h1 class="mb-8 text-lg lg:text-[42px] font-black text-center">Редактировать профиль</h1>

        <div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
            <form class="space-y-3" action="{{ route('profile.update', auth()->user()) }}" method="POST">
                @csrf

                <input type="text" name="name"
                    class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                    value="{{ auth()->user()->name }}" placeholder="Имя и фамилия" required>
                <input type="email" name="email"
                    class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                    value="{{ auth()->user()->email }}" placeholder="E-mail" required>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <input type="password" name="password"
                            class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                            placeholder="Пароль" required>
                    </div>
                    <div>
                        <input type="password" name="password_confirmation"
                            class="_is-error w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                            placeholder="Повторно пароль" required>
                        <div class="mt-3 text-pink text-xxs xs:text-xs">Введите пароль ещё раз</div>
                    </div>
                </div>
                <button type="submit" class="w-full btn btn-pink">Сохранить</button>
            </form>
        </div>

    </section>
@endsection
