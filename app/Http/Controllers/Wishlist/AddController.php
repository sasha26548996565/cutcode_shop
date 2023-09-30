<?php

declare(strict_types=1);

namespace App\Http\Controllers\Wishlist;

use App\Actions\Wishlist\ToggleProduct;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class AddController extends Controller
{
    private ToggleProduct $toggleProduct;

    public function __construct(ToggleProduct $toggleProduct)
    {
        $this->toggleProduct = $toggleProduct;
    }

    public function __invoke(Product $product): RedirectResponse
    {
        $this->toggleProduct->handle($product->id);
        return to_route('index');
    }
}
