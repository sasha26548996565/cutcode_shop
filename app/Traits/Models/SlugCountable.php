<?php

declare(strict_types=1);

namespace App\Traits\Models;

trait SlugCountable
{
    public function getCountSlug(string $slug): int
    {
        return self::where('slug', $slug)->count();
    }
}
