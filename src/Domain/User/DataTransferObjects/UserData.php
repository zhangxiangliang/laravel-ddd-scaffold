<?php

namespace Domain\User\DataTransferObjects;

use Auth;
use Domain\User\Models\User;
use Spatie\DataTransferObject\DataTransferObject;

class UserData extends DataTransferObject
{
    /**
     * ID
     *
     * @var int
     */
    public $id = 0;

    /**
     * 手机
     *
     * @var string
     */
    public $mobile = '';

    /**
     * OpenID
     *
     * @var string
     */
    public $openid = '';

    /**
     * SessionKey
     *
     * @var string
     */
    public $session_key = '';

    /**
     * 头像
     *
     * @var string
     */
    public $avatar = '';

    /**
     * 用户名
     *
     * @var string
     */
    public $username = '';

    /**
     * Token
     *
     * @var string
     */
    public $token = '';

    /**
     * 格式化模型数据
     *
     * @return self
     */
    public static function fromModel(User $user): self
    {
        return new static([
            'id' => $user->id,
            'mobile' => $user->mobile,
            'openid' => $user->openid,
            'session_key' => $user->session_key,
            'avatar' => $user->avatar,
            'username' => $user->username,
            'token' => Auth::login($user),
        ]);
    }
}
