@extends('layouts.auth')

@section('title', 'Восстановление пароля')

@section('content')
    <x-forms.auth-forms title='Восстановление пароля' action="{{ route('password.resetProccess') }}" method="POST">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <x-forms.text-input
            type='email'
            required='true'
            placeholder='E-mail'
            name='email'
            value="{{ request()->get('email') }}"
            :isError="$errors->has('email')"
        />
        @error('email')
            <x-forms.error>
                {{ $message }}
            </x-forms.error>
        @enderror

        <x-forms.text-input
            type='password'
            required='true'
            placeholder='Пароль'
            name='password'
            :isError="$errors->has('password')"
        />

        @error('password')
            <x-forms.error>
                {{ $message }}
            </x-forms.error>
        @enderror

        <x-forms.text-input
            type='password'
            required='true'
            placeholder='Подтвердите пароль'
            name='password_confirmation'
            :isError="$errors->has('password_confirmation')"
        />

        @error('password_confirmation')
            <x-forms.error>
                {{ $message }}
            </x-forms.error>
        @enderror

        <x-forms.primary-button>
            Отправить
        </x-forms.primary-button>

        <x-slot:buttons></x-slot:buttons>
        <x-slot:socialAuth></x-slot:socialAuth>
    </x-forms.auth-forms>
@endsection
