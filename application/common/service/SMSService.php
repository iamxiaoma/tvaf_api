<?php
namespace app\common\service;
use think\Model;
use RongCloud\RongCloud;

/**
 * 短信相关的Service
 */
class SMSService extends Model {


    /**
	 * 像指定的手机号发送6位数字的短信验证码
	 * @param  [type] $mobile [description]
	 * @return [type]         [description]
	 */
	public function send($country_code, $phone_number) {
		$templateId = config('rongcloud.common_sms_code_templateId');
		$appKey = config('rongcloud.app_key');
		$appSecret = config('rongcloud.app_secret');
		$RongCloud = new RongCloud($appKey, $appSecret);
		$region = $country_code;
        $result = $RongCloud->SMS()->sendCode($phone_number, $templateId, $region);
        $res = json_decode($result, true);
        if(isset($res['code']) && $res['code'] == 200){
            return $res['sessionId'];
        }else{
            exception($res['errorMessage'], app('ErrCode')::REMOTE_SERVICE_ERROR);
        }
	}

	/**
	 * 验证短信验证码是否正确
	 * @param  [type] $sessionId [description]
	 * @param  [type] $code      [description]
	 * @return [type]            [description]
	 */
	public function verify($sessionId, $code) {
		$appKey = config('rongcloud.app_key');
		$appSecret = config('rongcloud.app_secret');
		$RongCloud = new RongCloud($appKey, $appSecret);
		$result = $RongCloud->SMS()->verifyCode($sessionId, $code);
		$res = json_decode($result, true);
        if(isset($res['code']) && $res['code'] == 200 && $res['success'] == true){
            return true;
        }else{
            exception('验证码错误', app('ErrCode')::INVALID_VERIFY_CODE);
        }
	}

}