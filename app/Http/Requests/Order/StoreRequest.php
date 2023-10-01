<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'lastName' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'city' => ['required', 'string'],
            'address' => ['required', 'string'],
            'password' => ['nullable', 'string', 'confirmed'],
            'paymentMethod' => ['required', 'string'],
            'promocode' => ['nullable', 'exists:promocodes,name']
        ];
    }
}
