<?php

declare(strict_types=1);

namespace App\Actions\Order;

use App\DTO\OrderDTO;
use App\Models\Order;
use App\Models\Product;
use App\Models\Promocode;
use App\Actions\Cart\Clear;
use App\Actions\User\StoreUser;
use App\Events\OrderShipped;

class StoreOrder
{
    private Clear $clearCart;
    private StoreUser $storeUser;

    public function __construct()
    {
        $this->clearCart = new Clear();
        $this->storeUser = new StoreUser();
    }

    public function handle(OrderDTO $params): Order
    {
        if ($params->address || $params->city)
        {
            $params->pickup = false;
        }

        $params->totalPrice = $this->getTotalPrice($params->promocode);
        $order = Order::create($params->except('promocode', 'password')->toArray());
        $this->attachProducts($order);

        if ($params->promocode)
        {
            $this->attachPromocode($order, $params->promocode);
        }

        if ($params->password)
        {
            $this->storeUser($params->only('name', 'email', 'password'));
        }

        $this->clearCart->handle();
        event(new OrderShipped($order));

        return $order;
    }

    private function attachPromocode(Order $order, string $namePromocode): void
    {
        $promocode = Promocode::where('name', $namePromocode)->first();
        $order->promocode()->associate($promocode)->save();
    }

    private function attachProducts(Order $order): void
    {
        $cart = getCart();

        foreach ($cart as $cartItem)
        {
            $product = $cartItem->product;
            $order->products()->attach($product, [
                'count' => $cartItem->quantity,
                'optionValueIds' => json_encode($cartItem->optionValueIds)
            ]);
            $this->minusProductCount($product, $cartItem->quantity);
        }   
    }

    private function minusProductCount(Product $product, int $count): void
    {
        $product->count -= $count;
        $product->save();
    }

    private function storeUser(OrderDTO $params): void
    {
        $this->storeUser->handle([
            'name' => $params->name,
            'email' => $params->email,
            'password' => $params->password
        ]);
    }

    private function getTotalPrice(?string $namePromocode): int
    {
        $totalPrice = getTotalPriceInCart() * 100;
        $promocode = Promocode::where('name', $namePromocode)->first();
        
        if ($promocode)
        {
            $discount = $promocode->discount;
            $totalPrice = (int) ($totalPrice - ($totalPrice / 100 * $discount));
        }

        return (int) $totalPrice;
    }
}
