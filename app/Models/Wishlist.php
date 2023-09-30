<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Wishlist extends Model
{
    use HasFactory;

    public $fillable = [
        'session_id',
        'product_id',
        'user_id',
    ];

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id');
    }
}
