<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateUser
{
    public function handle(array $params, User $user): User
    {
        $user->update([
            'name' => $params['name'],
            'password' => Hash::make($params['password']),
        ]);
        return $user;
    }
}
