<div class="flex flex-wrap items-center gap-3 xs:gap-4">
    <div class="flex items-stretch h-[54px] lg:h-[72px] gap-2">
        <button type="button"
            class="w-12 h-full rounded-lg border border-body/10 hover:bg-card/20 active:bg-card/50 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs text-center font-bold shadow-transparent outline-0 transition">-</button>
        <input type="number"
            class="h-full px-2 md:px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs text-center font-bold shadow-transparent outline-0 transition"
            min="1" max="{{ $product->count }}" value="{{ getCurrentCountProductInCart($product->id) == 0 ? 1 : getCurrentCountProductInCart($product->id) }}" name="quantity" placeholder="К-во">
        <button type="button"
            class="w-12 h-full rounded-lg border border-body/10 hover:bg-card/20 active:bg-card/50 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs text-center font-bold shadow-transparent outline-0 transition">+</button>
    </div>
    <button type="submit" class="!px-6 xs:!px-8 btn btn-pink">Добавить в корзину</button>
    @include('catalog.partials.wishlist')
</div>
