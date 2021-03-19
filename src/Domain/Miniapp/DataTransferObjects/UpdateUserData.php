<?php

namespace Domain\Miniapp\DataTransferObjects;

use Auth;
use EasyWeChat;
use Spatie\DataTransferObject\DataTransferObject;

class UpdateUserData extends DataTransferObject
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
     * 格式化请求数据
     *
     * @return self
     */
    public static function fromRequest(): self
    {
        $user = Auth::user();

        // 生成小程序对象
        $wechat = EasyWeChat::miniProgram();

        // 获取手机号码
        $iv = request()->post('iv', null);
        $encryptedData = request()->post('encrypted_data', null);
        $decryptedData = $iv && $encryptedData && $user['mobile'] === ''
            ? $wechat->encryptor->decryptData($user["session_key"], $iv, $encryptedData)
            : ['phoneNumber' => null];

        // 获取用户信息
        $userProfile = [
            "avatar" => request()->post('avatar', null),
            "username" => request()->post('username', null),
            "province" => request()->post('province', null),
            "city" => request()->post('city', null),
            "district" => request()->post('district', null),
        ];

        return new self([
            // 原有数据
            'openid' => $user['openid'],
            'session_key' => $user['session_key'],

            // 更新数据
            'avatar' => $userProfile['avatar'] ? $userProfile['avatar'] : $user['avatar'],
            'username' => $userProfile['username'] ? $userProfile['username'] : $user['username'],
            'mobile' => $decryptedData['phoneNumber'] ? $decryptedData['phoneNumber'] : $user['mobile'],
        ]);
    }
}
