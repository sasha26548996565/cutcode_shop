<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'optionValueIds' => ['required', 'array'],
            'quantity' => ['required', 'integer']
        ];
    }
}
