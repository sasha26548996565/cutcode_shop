<aside class="basis-2/5 xl:basis-1/4">
    <form class="overflow-auto max-h-[320px] lg:max-h-[100%] space-y-10 p-6 2xl:p-8 rounded-2xl bg-card">
        @include('catalog.partials.filters.hidden-inputs')
        <!-- Filter item -->
        <div>
            <h5 class="mb-4 text-sm 2xl:text-md font-bold">Цена</h5>
            <div class="flex items-center justify-between gap-3 mb-2">
                <span class="text-body text-xxs font-medium">От, ₽</span>
                <span class="text-body text-xxs font-medium">До, ₽</span>
            </div>
            <div class="flex items-center gap-3">
                <input type="number"
                    name="filters[price][from]"
                    value="{{ request('filters.price.from', 0) }}"
                    class="w-full h-12 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                    value="9800" placeholder="От">
                <span class="text-body text-sm font-medium">–</span>
                <input type="number"
                    name="filters[price][to]"
                    value="{{ request('filters.price.to', 100000) }}"
                    class="w-full h-12 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                    value="142800" placeholder="До">
            </div>
        </div>
        <!-- Filter item -->
        <div>
            <h5 class="mb-4 text-sm 2xl:text-md font-bold">Бренд</h5>
            @foreach ($brands as $brand)
                <div class="form-checkbox">
                    <input
                        type="checkbox"
                        name="filters[brands][{{ $brand->id }}]"
                        id="filters-brands-{{ $brand->id }}"
                        value="{{ $brand->id }}"
                        @checked(request('filters.brands.' . $brand->id))
                    >
                    <label for="filters-brands-{{ $brand->id }}" class="form-checkbox-label">{{ $brand->title }}</label>
                </div>
            @endforeach
        </div>
        <!-- Filter item -->
        <div>
            <h5 class="mb-4 text-sm 2xl:text-md font-bold">Цвет</h5>
            <div class="form-checkbox">
                <input type="checkbox" id="filters-item-9">
                <label for="filters-item-9" class="form-checkbox-label">Белый</label>
            </div>
            <div class="form-checkbox">
                <input type="checkbox" id="filters-item-10">
                <label for="filters-item-10" class="form-checkbox-label">Чёрный</label>
            </div>
            <div class="form-checkbox">
                <input type="checkbox" id="filters-item-11">
                <label for="filters-item-11" class="form-checkbox-label">Желтый</label>
            </div>
            <div class="form-checkbox">
                <input type="checkbox" id="filters-item-12">
                <label for="filters-item-12" class="form-checkbox-label">Розовый</label>
            </div>
            <div class="form-checkbox">
                <input type="checkbox" id="filters-item-13">
                <label for="filters-item-13" class="form-checkbox-label">Красный</label>
            </div>
            <div class="form-checkbox">
                <input type="checkbox" id="filters-item-14">
                <label for="filters-item-14" class="form-checkbox-label">Серый</label>
            </div>
        </div>
        <!-- Filter item -->
        <div>
            <h5 class="mb-4 text-sm 2xl:text-md font-bold">Подсветка</h5>
            <div class="form-checkbox">
                <input type="checkbox" id="filters-item-7">
                <label for="filters-item-7" class="form-checkbox-label">Без подсветки</label>
            </div>
            <div class="form-checkbox">
                <input type="checkbox" id="filters-item-8">
                <label for="filters-item-8" class="form-checkbox-label">З подсветкой</label>
            </div>
        </div>
        <div>
            <button type="submit" class="w-full !h-16 btn btn-pink">Поиск</button>
        </div>
        @if (request('filters'))
            <div>
                <a href="{{ route('catalog.index', $category) }}" class="w-full !h-16 btn btn-outline">Сбросить фильтры</a>
            </div>
        @endif
    </form>
</aside>
