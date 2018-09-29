<?php

namespace app\http\middleware;

class Weapp
{
    public function handle($request, \Closure $next)
    {
        //echo 'weapp 中间件前置动作，可以进行身份认证等动作</br>';
        $token = !empty($request->header('token')) ? $request->header('token') : '';

        if(empty($token)){
            exception('未登录', app('ErrCode')::UNAUTHORIZED);
        }
        // 解密token对应的内容
        $token_arr = app('jwtService')->checkJWT($token, app('JwtType')::WEAPP);
        $request->member_id = $token_arr['sub']; // 解析出member_id
        // 中间件的前置行为
        return $next($request);
    }
}
