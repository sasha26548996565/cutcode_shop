<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionValueProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'option_values_id',
        'product_id',
    ];
}
