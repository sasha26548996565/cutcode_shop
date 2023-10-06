<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Events\UserRegistered;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $params = $request->validated();
        $user = User::where('email', $params['email'])->first();

        if ($user == null && Hash::check($params['password'], $user->password) == false) 
        {
            return back()->withErrors(['email' => 'Пользователь не найден!'])
                ->onlyInput('email');
        }

        event(new UserRegistered($user));
        Auth::login($user);
        
        return redirect()->intended(route('index'));
    }
}
