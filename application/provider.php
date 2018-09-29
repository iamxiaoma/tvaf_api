<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用容器绑定定义
return [

    // Model 相关定义
    'memberModel' => app\common\model\Member::class,
    'memberAuthorityModel' => app\common\model\MemberAuthority::class,

    // Service 相关定义
    'jwtService' => app\common\service\JWTService::class,
    'loginService' => app\common\service\LoginService::class,
    'accountService' => app\common\service\AccountService::class,
    'memberService' => app\common\service\MemberService::class,
    'wechatService' => app\common\service\WechatService::class,
    'qiniuService' => app\common\service\QiniuService::class,
    'smsService' => app\common\service\SMSService::class,

    // 常量定义
    'ErrCode' => app\common\enum\ErrCode::class, // 错误代码
    'JwtType' => app\common\enum\JwtType::class, // jwt 加密的类型
    'Platform' => app\common\enum\Platform::class,  // 平台类型
    'Sex' => app\common\enum\Sex::class, // 性别

];
