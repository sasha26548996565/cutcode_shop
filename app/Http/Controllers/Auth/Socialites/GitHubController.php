<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth\Socialites;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class GitHubController extends Controller
{
    private const LENGTH_PASSWORD = 8;

    public function redirectToGitHub(): RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGitHubCallback(): RedirectResponse
    {
        $githubUser = Socialite::driver('github')->user();
     
        $user = User::updateOrCreate([
            'github_id' => $githubUser->id,
        ], [
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'password' => Hash::make(Str::random(self::LENGTH_PASSWORD))
        ]);
     
        Auth::login($user);
     
        return redirect()->intended(route('index'));
    }
}
