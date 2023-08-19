@if (request('sort'))
    <input type="hidden" name="sort" value="{{ request('sort') }}">
@endif
