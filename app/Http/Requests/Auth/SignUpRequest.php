<?php

namespace App\Http\Requests\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::guest();
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email:dns', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()]
        ];
    }

    protected function prepareForValidation(): string
    {
        return $this->merge([
            'email' => str(request('email'))
                ->squish()
                ->lower()
                ->value()
        ]);
    }
}
