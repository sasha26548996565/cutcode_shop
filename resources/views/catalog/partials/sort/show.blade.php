<div x-data="{}" class="flex flex-col sm:flex-row sm:items-center gap-3">
    <span class="text-body text-xxs sm:text-xs">Сортировать по</span>
    <form x-ref="sortForm" action="{{ route('catalog.index', $category) }}">
        @include('catalog.partials.filters.hidden-inputs')
        <select
            name="sort"
            x-on:change="$refs.sortForm.submit()"
            class="form-select w-full h-12 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xxs sm:text-xs shadow-transparent outline-0 transition">
            <option value="" class="text-dark">умолчанию</option>
            <option @selected(request('sort') == 'price|asc')
                value="price|asc"
                class="text-dark"
            >
                от дешевых к дорогим
            </option>

            <option @selected(request('sort') == 'price|desc')
                value="price|desc"
                class="text-dark"
            >
                от дорогих к дешевым
            </option>

            <option @selected(request('sort') == 'title|asc')
                value="title|asc"
                class="text-dark"
            >
                наименованию
            </option>
        </select>
    </form>
</div>