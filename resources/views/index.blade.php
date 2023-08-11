@extends('layouts.auth')

@section('title', 'Главная')

@section('content')
    @auth
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            @method('DELETE')
            <input type="submit" style="cursor: pointer;" value="Выйти">
        </form>
    @endauth
@endsection
