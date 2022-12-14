<?php

namespace App\Http\Controllers\ApiV1\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiV1\Account\ProfileUpdateRequest;
use App\Http\Resources\ApiV1\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use function auth;

class ProfileController extends Controller
{
    public function __construct(
        private UserService $userService
    )
    {
    }

    /**
     * Показывает профиль
     *
     * @param Request $request
     * @return UserResource
     */
    public function show(Request $request): UserResource
    {
        return UserResource::make($request->user());
    }

    /**
     * Обновляет профиль
     *
     * @param ProfileUpdateRequest $request
     * @return UserResource
     */
    public function update(ProfileUpdateRequest $request): UserResource
    {
        $data = $request->validated();

        $user = $this->userService->update(auth()->id(), $data);

        return UserResource::make($user);
    }
}
