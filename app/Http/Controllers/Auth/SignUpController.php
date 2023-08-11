<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\SignUpRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    public function showSignUp(): View
    {
        return view('auth.sign-up');
    }

    public function signUp(SignUpRequest $request): RedirectResponse
    {
        $params = $request->validated();
        $user = User::create([
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => Hash::make($params['password']),
        ]);
        Auth::login($user);

        return redirect()->intended(route('index'));
    }
}
