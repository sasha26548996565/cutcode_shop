<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contract\Repositories\CartContract;
use App\Repositories\CartRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            CartContract::class,
            CartRepository::class,
        );
    }
}
