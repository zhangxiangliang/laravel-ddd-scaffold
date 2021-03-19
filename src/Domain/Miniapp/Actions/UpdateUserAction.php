<?php

namespace Domain\Miniapp\Actions;

// User Domain
use Domain\User\Models\User;

// Miniapp Domain
use Domain\Miniapp\DataTransferObjects\UpdateUserData;

class UpdateUserAction
{
    public function __invoke(UpdateUserData $updateUserData): User
    {
        $user = User::query()->firstOrFail();
        $user->update($updateUserData->toArray());

        return $user;
    }
}
