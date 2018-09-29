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

    'jwtService' => app\common\service\JWTService::class,
    'loginService' => app\common\service\LoginService::class,

    'ErrCode' => app\common\enum\ErrCode::class,
    'JwtType' => app\common\enum\JwtType::class,

];
