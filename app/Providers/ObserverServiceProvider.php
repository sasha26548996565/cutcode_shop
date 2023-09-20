<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Cart;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Observers\CartObserver;
use App\Observers\BrandObserver;
use App\Observers\ProductObserver;
use App\Observers\CategoryObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Brand::observe(BrandObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
        Cart::observe(CartObserver::class);
    }
}
