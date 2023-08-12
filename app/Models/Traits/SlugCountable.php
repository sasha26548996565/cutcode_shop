<?php

declare(strict_types=1);

namespace App\Models\Traits;

trait SlugCountable
{
    public function getCountSlug(string $slug): int
    {
        return self::where('slug', $slug)->count();
    }
}
