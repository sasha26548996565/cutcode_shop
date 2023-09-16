<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Cart\AddRequest;

class CartController extends Controller
{
    public function add(Product $product, AddRequest $request): void
    {
        //dto
        $params = $request->validated();
        dd($params, $product);
    }
}
