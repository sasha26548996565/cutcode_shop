<?php

namespace App\Http\Requests\Catalog;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'filters.price.from' => ['nullable', 'numeric'],
            'filters.price.to' => ['nullable', 'numeric'],
            'filters.brands' => ['nullable', 'array'],
            'filters.optionValueIds' => ['nullable', 'array'],
            'sort' => ['nullable', 'string'],
            'search' => ['nullable', 'string'],
        ];
    }
}
