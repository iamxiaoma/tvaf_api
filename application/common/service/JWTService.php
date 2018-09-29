<?php
namespace app\common\service;
use \Firebase\JWT\JWT;
use think\Model;
/**
 * jwt处理逻辑
 */
class JWTService extends Model {

    /**
     * 使用指定的数据，生成jwt，进行加密处理
     *
     * @param [type] $data
     * @return void
     */
    public function getJWT($data, $key){

        // iss: jwt签发者
        // sub: jwt所面向的用户
        // aud: 接收jwt的一方
        // exp: jwt的过期时间，这个过期时间必须要大于签发时间
        // nbf: 定义在什么时间之前，该jwt都是不可用的.
        // iat: jwt的签发时间
        // jti: jwt的唯一身份标识，主要用来作为一次性token,从而回避重放攻击。

        return JWT::encode($data, $key);
    }

    /**
     * 检查jwt，并返回对应的数据，进行解密处理
     *
     * @param [type] $jwt
     * @return void
     */
    public function checkJWT($jwt, $key){
        try{
            $decoded = JWT::decode($jwt, $key, array('HS256'));
            if($decoded){
                $decoded_array = (array) $decoded;
                return $decoded_array;
            }
            return null;
        }catch(\Exception $e){
            $code = $e->getCode();
            $msg = $e->getMessage();
            // 签名已过期
            if($msg == 'Expired token'){
                exception('Token 已过期', app('ErrCode')::TOKEN_EXPIRES);
            }else{
                exception('Token 错误', app('ErrCode')::TOKEN_ERROR);
            }
        }
    }





}