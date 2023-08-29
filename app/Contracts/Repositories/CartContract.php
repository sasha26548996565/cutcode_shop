<?php

declare(strict_types=1);

namespace App\Contract\Repositories;

interface CartContract
{
    public function add(): void;
    public function remove(): void;
    public function getAll(): void;
    public function getCount(): void;
}
