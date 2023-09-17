<?php

declare(strict_types=1);

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface CartContract
{
    public function get(int $productId): Collection;
    public function getAll(): Collection;
    public function getCount(): void;
}
