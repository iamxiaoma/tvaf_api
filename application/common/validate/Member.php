<?php
namespace app\common\validate;

use think\Validate;


class Member extends Validate{


    protected $rule = [
        'id' => 'require',
        'account' => 'require',
        'name' => 'require',
        'password' => 'require',
        'old_password' => 'require',
        'new_password' => 'require|confirm:confirm_password',
        'confirm_password' => 'require|confirm:new_password',
        'real_name' => 'require',
        'code' => 'require',
        'openid' => 'require',
        'region' => 'require',
        'mobile' => 'require',
        'verify_code' => 'require',
        'sessionId' => 'require',
    ];

    protected $message = [
        'id.require' => 'id必填',
        'account.require' => '登录账号必填',
        'name.require' => '昵称必填',
        'password.require' => '登录密码必填',
        'old_password.require' => '旧密码必填',
        'new_password.require' => '新密码必填',
        'confirm_password.require' => '确认密码必填',
        'old_password.confirm' => '新密码不一致',
        'new_password.confirm' => '新密码不一致',
        'real_name.require' => '姓名必填',
        'code.require' => 'code 必填',
        'openid.require' => 'openid 必填',
        'region.require' => '国家区位码必填',
        'mobile.require' => '手机号码必填',
        'verify_code.require' => '验证码必填',
        'sessionId' => 'sessionId必填'
    ];

    protected $scene = [
        'weapp_login' => ['code'],
        'sms_send' => ['region', 'mobile'],
        'weapp_bind' => ['openid', 'region', 'mobile', 'verify_code', 'sessionId']
    ];
}