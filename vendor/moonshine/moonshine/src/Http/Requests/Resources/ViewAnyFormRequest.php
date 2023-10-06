<?php

declare(strict_types=1);

namespace MoonShine\Http\Requests\Resources;

use MoonShine\MoonShineRequest;

final class ViewAnyFormRequest extends MoonShineRequest
{
    public function authorize(): bool
    {
        return $this->getResource()->can('viewAny');
    }

    public function hasQueryTag(): bool
    {
        return ! is_null($this->route('queryTag'));
    }

    public function getQueryTag(): ?string
    {
        return $this->route('queryTag');
    }
}
