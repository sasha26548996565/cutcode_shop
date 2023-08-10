<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductObserver
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function creating(Product $product): void
    {
        $slug = Str::slug($product->title);
        $countSlug = $this->product->getCountSlug($slug);

        if ($countSlug > 0)
        {
            $slug .= '-' . ($countSlug + 1);
        }

        $product->slug = $slug;
    }
}
