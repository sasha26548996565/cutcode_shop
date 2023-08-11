<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $params = $request->validated();

        if (Auth::attempt($params) == false) 
        {
            return back()->withErrors(['email' => 'Пользователь не найден!'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();
        return redirect()->intended(route('index'));
    }
}
