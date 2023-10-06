<?php

declare(strict_types=1);

namespace App\Http\Controllers\Order;

use App\Actions\Order\DestroyOrder;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{
    private DestroyOrder $destroyOrder;

    public function __construct(DestroyOrder $destroyOrder)
    {
        $this->destroyOrder = $destroyOrder;
    }

    public function __invoke(Order $order): RedirectResponse
    {
        $this->destroyOrder->handle($order);
        return to_route('order.index');
    }
}
