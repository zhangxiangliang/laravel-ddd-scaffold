<?php

namespace App\Api\Controllers;

// Laravel Domain
use Illuminate\Routing\Controller;

// User Domain
use Domain\User\Resources\UserResource;

// Miniapp Domain
use Domain\Miniapp\Actions\GetUserAction;
use Domain\Miniapp\Actions\UpdateUserAction;
use Domain\Miniapp\DataTransferObjects\CreateUserData;
use Domain\Miniapp\DataTransferObjects\UpdateUserData;

/**
 * 小程序接口控制器
 */
class MiniappController extends Controller
{
    /**
     * 小程序登录
     *
     * @return \Domain\User\Resources\UserResource
     */
    public function login()
    {
        // 请求数据
        $createUserData = CreateUserData::fromRequest();

        // 处理数据
        $user = (new GetUserAction)($createUserData);

        // 响应数据
        return new UserResource($user);
    }

    /**
     * 小程序更新
     *
     * @return \Domain\User\Resources\UserResource
     */
    public function update()
    {
        // 请求数据
        $updateUserData = UpdateUserData::fromRequest();

        // 处理数据
        $user = (new UpdateUserAction)($updateUserData);

        // 响应数据
        return new UserResource($user);
    }
}
