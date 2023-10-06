<?php

declare(strict_types=1);

namespace App\Http\Controllers\Order;

use App\Actions\Order\StoreOrder;
use App\DTO\OrderDTO;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Order\StoreRequest;

class StoreController extends Controller
{
    private StoreOrder $storeOrder;

    public function __construct(StoreOrder $storeOrder)
    {
        $this->storeOrder = $storeOrder;
    }

    public function __invoke(StoreRequest $request): RedirectResponse
    {
        $params = new OrderDTO($request->validated());
        $this->storeOrder->handle($params);
        return to_route('index');
    }
}
