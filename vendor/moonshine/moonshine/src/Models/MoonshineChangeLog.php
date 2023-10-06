<?php

declare(strict_types=1);

namespace MoonShine\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use MoonShine\MoonShineAuth;

class MoonshineChangeLog extends Model
{
    protected $with = ['moonshineUser'];

    protected $fillable = [
        'moonshine_user_id',
        'changelogable_id',
        'changelogable_type',
        'states_before',
        'states_after',
    ];

    protected $casts = [
        'states_before' => 'array',
        'states_after' => 'array',
    ];

    public function moonshineUser(): BelongsTo
    {
        $model = MoonShineAuth::model();

        return $this->belongsTo(
            $model::class,
            'moonshine_user_id',
            $model->getKeyName(),
        );
    }

    public function changelogable(): MorphTo
    {
        return $this->morphTo();
    }
}
