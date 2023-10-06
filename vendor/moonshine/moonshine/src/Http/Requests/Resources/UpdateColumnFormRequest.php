<?php

declare(strict_types=1);

namespace MoonShine\Http\Requests\Resources;

use MoonShine\Fields\Field;
use MoonShine\MoonShineRequest;
use Throwable;

final class UpdateColumnFormRequest extends MoonShineRequest
{
    public function authorize(): bool
    {
        if (! in_array(
            'edit',
            $this->getResource()->getActiveActions(),
            true
        )) {
            return false;
        }

        if (! $this->field() instanceof Field) {
            return false;
        }

        return $this->getResource()->can('update');
    }

    /**
     * @throws Throwable
     */
    public function field(): ?Field
    {
        return $this->getResource()
            ->getField(request('field', ''));
    }

    /**
     * @return array{field: string[], value: string[]}
     */
    public function rules(): array
    {
        return [
            'field' => ['required'],
            'value' => ['required'],
        ];
    }
}
