<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastName',
        'email',
        'phone',
        'city',
        'address',
        'paymentMethod',
        'pickup',
        'totalPrice',
        'promocode_id',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id')
            ->withPivot([
                'count',
                'optionValueIds'
            ]);
    }

    public function promocode(): BelongsTo
    {
        return $this->belongsTo(Promocode::class, 'promocode_id', 'id');
    }

    public function totalPrice(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100
        );
    }
}
