<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function optionValues(): HasMany
    {
        return $this->hasMany(OptionValue::class, 'option_values', 'option_id');
    }
}
