<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OptionValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'option_id',
    ];

    public function option(): BelongsTo
    {
        return $this->belongsTo(OptionValue::class, 'option_id', 'id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'option_value_products', 'option_values_id', 'product_id');
    }
}
