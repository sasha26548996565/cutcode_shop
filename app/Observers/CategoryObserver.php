<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function creating(Category $category): void
    {
        $slug = Str::slug($category->title);
        $countSlug = $this->category->getCountSlug($slug);

        if ($countSlug > 0)
        {
            $slug .= '-' . ($countSlug + 1);
        }

        $category->slug = $slug;
    }
}
