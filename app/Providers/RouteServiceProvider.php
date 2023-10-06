<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/';

    private array $apiRoutePaths = [
        'routes/api.php',
    ];

    private array $webRoutePaths = [
        'routes/web.php',
        'routes/auth.php',
        'routes/product.php',
        'routes/catalog.php',
        'routes/cart.php',
        'routes/wishlist.php',
        'routes/checkout.php',
        'routes/order.php',
        'routes/profile.php',
    ];

    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            $this->apiRegister($this->apiRoutePaths);
            $this->webRegister($this->webRoutePaths);
        });
    }

    private function apiRegister(array $paths): void
    {
        foreach ($paths as $filePath)
        {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path($filePath));
        }
    }

    private function webRegister(array $paths): void
    {
        foreach ($paths as $filePath)
        {
            Route::middleware('web')
                ->group(base_path($filePath));
        }
    }
}
