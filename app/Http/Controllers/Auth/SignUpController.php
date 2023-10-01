<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Events\UserRegistered;
use App\Actions\User\StoreUser;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\SignUpRequest;

class SignUpController extends Controller
{
    private StoreUser $storeUser;

    public function __construct(StoreUser $storeUser)
    {
        $this->storeUser = $storeUser;
    }

    public function showSignUp(): View
    {
        return view('auth.sign-up');
    }

    public function signUp(SignUpRequest $request): RedirectResponse
    {
        $params = $request->validated();
        $user = $this->storeUser->handle($params);
        
        event(new UserRegistered($user));
        Auth::login($user);

        return redirect()->intended(route('index'));
    }
}
