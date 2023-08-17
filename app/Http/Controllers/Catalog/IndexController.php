<?php

declare(strict_types=1);

namespace App\Http\Controllers\Catalog;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    private const PAGINATION_COUNT = 12;

    public function __invoke(): View
    {
        $categories = Category::latest()->get();
        $products = Product::latest()->paginate(self::PAGINATION_COUNT);

        return view('catalog.index', compact('categories', 'products'));
    }
}
