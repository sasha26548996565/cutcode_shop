@if (request('filter.brands'))
    @foreach (request('filters.brands') as $brand)
        <input type="hidden" name="filters[brands][{{ $brand }}]" value="{{ $brand }}">
    @endforeach
@endif

@if (request('filters.price'))
    <input type="hidden" name="filters[price][from]" value="{{ request('filters.price.from') }}">
    <input type="hidden" name="filters[price][to]" value="{{ request('filters.price.to') }}">
@endif
