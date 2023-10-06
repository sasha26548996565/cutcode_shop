<?php

declare(strict_types=1);

namespace App\Traits\Models;

use App\Http\Filters\FilterContract;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    public function scopeFilter(Builder $builder, FilterContract $filter)
    {
        $filter->apply($builder);

        return $builder;
    }
}
