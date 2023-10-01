<?php

namespace App\Http\Requests\Checkout\Promocode;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required']
        ];
    }
}
