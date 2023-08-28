<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'option_id',
        'category_id',
    ];
}
