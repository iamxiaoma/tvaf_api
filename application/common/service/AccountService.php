<?php
namespace app\common\service;
use think\Model;
use think\Db;

/**
 * 账号相关的Service
 */
class AccountService extends Model {

    /**
     * 小程序账号绑定手机号码
     *
     * @return void
     */
    public function weapp_bind($params){
        // 验证短信验证码
        //$verify_result = app('smsService')->verify($params['sessionId'], $params['verify_code']);
        $verify_result = true;
        // 验证码验证通过
        if($verify_result){
            // 启动事务
            Db::startTrans();
            try{
                // 进行账号检查及关联
                $member = app('memberModel')->getByMobile($params['region'], $params['mobile']);
                $member_id = 0;
                if($member != null){
                    $member_id = $member['id'];
                }else{
                    $data = array(
                        'region' => $params['region'],
                        'mobile' => $params['mobile'],
                    );
                    $member_id = app('memberModel')->add($data);
                }
                // 关联会员与小程序授权记录
                app('memberAuthorityModel')->updateAuthMember($params['openid'], app('Platform')::WECHAT_WEAPP, $member_id);
                // 提交事务
                Db::commit();

                $payload = array(
                    'iss' => 'tvaf',
                    'sub' => $member_id,
                    'aud' => 'weapp',
                    'iat' => time(),
                    'exp' => strtotime('+1 minute'),
                    'jti' => get_random()
                );

                $jwt = app('jwtService')->getJWT($payload, app('JwtType')::WEAPP);
                return $jwt;
            } catch (\Exception $e){
                // 回滚事务
                Db::rollback();
                exception($e->getMessage(), $e->getCode());
            }
        }

    }
}