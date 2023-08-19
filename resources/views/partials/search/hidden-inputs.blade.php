@if (request('search'))
    <input type="hidden" name="search" value="{{ request('search') }}">
@endif
