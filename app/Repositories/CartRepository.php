<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contract\Repositories\CartContract;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Collection;

class CartRepository implements CartContract
{
    public function getAll(): Collection
    {
        return Cart::where('session_id', session()->getId())->get();
    }

    public function get(int $productId): Collection
    {
        return Cart::where([
            'session_id' => session()->getId(),
            'product_id' => $productId
        ])->first();
    }
    
    public function getCount(): void
    {}
}
