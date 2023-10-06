<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cart;

use App\Actions\Cart\Clear;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ClearController extends Controller
{
    private Clear $clear;

    public function __construct(Clear $clear)
    {
        $this->clear = $clear;    
    }

    public function __invoke(): RedirectResponse
    {
        $this->clear->handle();

        return to_route('index');
    }
}
