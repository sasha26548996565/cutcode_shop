<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', env('APP_NAME'))</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/sass/main.sass', 'resources/js/app.js'])
    </head>
    <body>
        @include('partials.flash')
        <main class="md:min-h-screen md:flex md:items-center md:justify-center py-16 lg:py-20">
            <div class="container">
       
               <!-- Page heading -->
               <div class="text-center">
                   <a href="{{ route('index') }}" class="inline-block" rel="home">
                       <img src="{{ Vite::image('logo.svg') }}" class="w-[148px] md:w-[201px] h-[36px] md:h-[50px]" alt="CutCode">
                   </a>
               </div>
       
               @yield('content')
       
           </div>
        </main>
    </body>
</html>
