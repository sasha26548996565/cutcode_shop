<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Brand;
use Illuminate\Support\Str;

class BrandObserver
{
    private Brand $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    public function creating(Brand $brand): void
    {
        $slug = Str::slug($brand->title);
        $countSlug = $this->brand->getCountSlug($slug);

        if ($countSlug > 0)
        {
            $slug .= '-' . ($countSlug + 1);
        }

        $brand->slug = $slug;
    }
}
