<?php

namespace Domain\Miniapp\Actions;

use Domain\User\Models\User;
use Domain\Miniapp\DataTransferObjects\CreateUserData;

class GetUserAction
{
    public function __invoke(CreateUserData $createUserData): User
    {
        $user = User::updateOrCreate(
            ['openid' => $createUserData->openid],
            $createUserData->toArray()
        );

        return $user;
    }
}
