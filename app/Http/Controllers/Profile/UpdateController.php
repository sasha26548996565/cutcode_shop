<?php

declare(strict_types=1);

namespace App\Http\Controllers\Profile;

use App\Actions\User\UpdateUser;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateRequest;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{
    private UpdateUser $updateUser;
    
    public function __construct(UpdateUser $updateUser)
    {
        $this->updateUser = $updateUser;
    }

    public function __invoke(UpdateRequest $request, User $user): RedirectResponse
    {
        $params = $request->validated();
        $this->updateUser->handle($params, $user);
        return to_route('index');
    }
}
