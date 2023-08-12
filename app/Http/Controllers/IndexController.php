<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        $brands = Brand::indexPage()->get();
        $categories = Category::indexPage()->get();
        $products = Product::indexPage()->get();
        
        return view('index', compact('brands', 'categories', 'products'));
    }
}
