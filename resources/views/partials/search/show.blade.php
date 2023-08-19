<form action="{{ route('catalog.index') }}" method="GET" class="hidden lg:flex gap-3">
    @include('catalog.partials.filters.hidden-inputs')
    @include('catalog.partials.sort.hidden-inputs')
    <input type="search" name="search" value="{{ request('search') }}" class="w-full h-12 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition" placeholder="Поиск..." required>
    <button type="submit" class="shrink-0 w-12 !h-12 !px-0 btn btn-pink">
        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 52 52">
            <path d="M50.339 47.364 37.963 34.492a20.927 20.927 0 0 0 4.925-13.497C42.888 9.419 33.47 0 21.893 0 10.317 0 .898 9.419.898 20.995S10.317 41.99 21.893 41.99a20.77 20.77 0 0 0 12.029-3.8l12.47 12.97c.521.542 1.222.84 1.973.84.711 0 1.386-.271 1.898-.764a2.742 2.742 0 0 0 .076-3.872ZM21.893 5.477c8.557 0 15.518 6.961 15.518 15.518s-6.96 15.518-15.518 15.518c-8.556 0-15.518-6.961-15.518-15.518S13.337 5.477 21.893 5.477Z"/>
        </svg>
    </button>
</form>