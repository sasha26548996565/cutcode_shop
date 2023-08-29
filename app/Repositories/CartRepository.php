<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contract\Repositories\CartContract;

class CartRepository implements CartContract
{
    public function add(): void
    {}

    public function remove(): void
    {}

    public function getAll(): void
    {}
    
    public function getCount(): void
    {}
}
