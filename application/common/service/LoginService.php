<?php
namespace app\common\service;
use think\Model;
/**
 * 登录处理逻辑
 */
class LoginService extends Model {

    /**
     * 小程序通过 code 进行登录
     *
     * @param [type] $code
     * @return void
     */
    public function weapp($code){

        

        // iss: jwt签发者
        // sub: jwt所面向的用户
        // aud: 接收jwt的一方
        // exp: jwt的过期时间，这个过期时间必须要大于签发时间
        // nbf: 定义在什么时间之前，该jwt都是不可用的.
        // iat: jwt的签发时间
        // jti: jwt的唯一身份标识，主要用来作为一次性token,从而回避重放攻击。

        $payload = array(
            'iss' => 'tvaf',
            'sub' => 1,
            'aud' => 'weapp',
            'iat' => time(),
            'exp' => time() + 100,
            'jti' => get_random()
        );

        $jwt = app('jwtService')->getJWT($payload, app('JwtType')::WEAPP);

        return $jwt;
    }
    

}