<?php
namespace app\common\service;
use think\Model;
use think\Db;
/**
 * 登录处理逻辑
 */
class LoginService extends Model {

    /**
     * 小程序通过 code 进行登录
     *
     * @param [type] $params
     * @return void
     */
    public function weapp($params){

        // 通过小程序 code 获取会员信息
        $weuser_info = app('wechatService')->miniGetSession($params['code']);

        if(isset($weuser_info['errcode']) && $weuser_info['errcode'] === 40029){
            exception('无效Code', app('ErrCode')::INVALID_CODE);
        }

        if(isset($weuser_info['errcode']) && $weuser_info['errcode'] === 40163){
            exception('Code已使用', app('ErrCode')::CODE_BEEN_USED);
        }

        if(isset($weuser_info['errcode'])){
            exception($weuser_info['errmsg'], app('ErrCode')::WEAPP_ERROR);
        }

        $openid = $weuser_info['openid'];
        
        // 启动事务
        Db::startTrans();
        try{

            // 检查指定平台的授权记录是否存在
            $memberAuth = app('memberAuthorityModel')->getByOpenIdAndPlatform($openid, app('Platform')::WECHAT_WEAPP);
            if($memberAuth == null){
                // 新增授权记录
                $data = array(
                    'member_id' => 0,
                    'openid' => $openid,
                    'nickname' => isset($params['nickname']) ? $params['nickname'] : "",
                    'headimgurl' => isset($params['headimgurl']) ? $params['headimgurl'] : "",
                    'sex' => isset($params['sex']) ? $params['sex'] : app('Sex')::MALE,
                    'country' => isset($params['country']) ? $params['country'] : "",
                    'province' => isset($params['province']) ? $params['province'] : "",
                    'city' => isset($params['city']) ? $params['city'] : "",
                    'platform' => app('Platform')::WECHAT_WEAPP
                );
                app('memberAuthorityModel')->add($data);
                // 提交事务
                Db::commit();
                return array(
                    'token' => '',
                    'openid' => $openid,
                );
            }else{
                // 更新授权记录
                $memberAuth['nickname'] = isset($params['nickname']) ? $params['nickname'] : "";
                $memberAuth['headimgurl'] = isset($params['headimgurl']) ? $params['headimgurl'] : "";

                $data = array(
                    'id' => $memberAuth['id'],
                    'member_id' => $memberAuth['member_id'],
                    'nickname' => isset($params['nickname']) ? $params['nickname'] : "",
                    'headimgurl' => isset($params['headimgurl']) ? $params['headimgurl'] : "",
                    'sex' => isset($params['sex']) ? $params['sex'] : app('Sex')::MALE,
                    'country' => isset($params['country']) ? $params['country'] : "",
                    'province' => isset($params['province']) ? $params['province'] : "",
                    'city' => isset($params['city']) ? $params['city'] : "",
                );

                app('memberAuthorityModel')->edit($data);
                 // 提交事务
                Db::commit();

                if($memberAuth['member_id'] == 0){
                    return array(
                        'token' => '',
                        'openid' => $openid,
                    );
                }
                // iss: jwt签发者
                // sub: jwt所面向的用户
                // aud: 接收jwt的一方
                // exp: jwt的过期时间，这个过期时间必须要大于签发时间
                // nbf: 定义在什么时间之前，该jwt都是不可用的.
                // iat: jwt的签发时间
                // jti: jwt的唯一身份标识，主要用来作为一次性token,从而回避重放攻击。

                $payload = array(
                    'iss' => 'tvaf',
                    'sub' => $memberAuth['member_id'],
                    'aud' => 'weapp',
                    'iat' => time(),
                    'exp' => strtotime('+1 day'),
                    'jti' => get_random()
                );

                $jwt = app('jwtService')->getJWT($payload, app('JwtType')::WEAPP);

                return array(
                    'token' => $jwt,
                    'openid' => '',
                );
            }
        } catch(\Exception $e){
            // 回滚事务
            Db::rollback();
            exception($e->getMessage(), $e->getCode());
        }
        
    }
    

}