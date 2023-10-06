<tr>
    <td scope="row" class="py-4 px-6 rounded-l-2xl bg-card">
        <div class="flex flex-col lg:flex-row min-w-[200px] gap-2 lg:gap-6">
            <div class="shrink-0 overflow-hidden w-[64px] lg:w-[84px] h-[64px] lg:h-[84px] rounded-2xl">
                <img src="{{ $product->makeThumbnail('345x320') }}" class="object-cover w-full h-full" alt="SteelSeries Aerox 3 Snow">
            </div>
            <div class="py-3">
                <h4 class="text-xs sm:text-sm xl:text-md font-bold">
                    <a href="{{ route('product.show', $product) }}" class="inline-block text-white hover:text-pink">
                        {{ $product->title }}
                    </a>
                </h4>
                <ul class="space-y-1 mt-2 text-xs">
                    @foreach ($product->optionValues as $optionValue)
                        @if (in_array($optionValue->id, json_decode($product->pivot->optionValueIds)))
                            <li class="text-body">{{ $optionValue->option->title }}: {{ $optionValue->title }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </td>
    <td class="py-4 px-6 bg-card">
        <div class="font-medium whitespace-nowrap">{{ $product->price }} ₽</div>
    </td>
    <td class="py-4 px-6 bg-card">{{ $product->pivot->count }}</td>
    <td class="py-4 px-6 bg-card rounded-r-2xl">
        <div class="font-medium whitespace-nowrap">{{ $product->pivot->count * $product->price }} ₽</div>
    </td>
</tr>