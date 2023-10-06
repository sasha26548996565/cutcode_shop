<x-mail::message>
Ваш заказ отправлен!

@foreach ($order->products as $product)
<a href="{{ route('product.show', $product) }}">{{ $product->title }}</a>
@endforeach

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
