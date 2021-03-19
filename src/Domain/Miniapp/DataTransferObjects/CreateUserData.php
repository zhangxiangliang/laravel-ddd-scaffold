<?php

namespace Domain\Miniapp\DataTransferObjects;

use Str;
use Hash;
use EasyWeChat;
use Domain\User\Models\User;
use Spatie\DataTransferObject\DataTransferObject;

class CreateUserData extends DataTransferObject
{
    /**
     * 手机
     *
     * @var string
     */
    public $mobile;

    /**
     * OpenID
     *
     * @var string
     */
    public $openid;

    /**
     * SessionKey
     *
     * @var string
     */
    public $session_key;

    /**
     * 头像
     *
     * @var string
     */
    public $avatar;

    /**
     * 用户名
     *
     * @var string
     */
    public $username;

    /**
     * 密码
     *
     * @var string
     */
    public $password;

    /**
     * 格式化请求数据
     *
     * @return self
     */
    public static function fromRequest(): self
    {
        $wechat = EasyWeChat::miniProgram();
        $authorization = $wechat->auth->session(request()->post('code'));

        $user = User::firstOrNew(['openid' => $authorization['openid']], [
            'mobile' => '',
            'openid' => $authorization['openid'],
            'session_key' => $authorization['session_key'],

            'avatar' => '',
            'username' => '',
            'password' => Hash::make(Str::random(12)),
        ]);

        return new self([
            'mobile' => $user['mobile'],
            'openid' => $authorization['openid'],
            'session_key' => $authorization['session_key'],

            'avatar' => $user['avatar'],
            'username' => $user['username'],
            'password' => $user['password'],
        ]);
    }
}
