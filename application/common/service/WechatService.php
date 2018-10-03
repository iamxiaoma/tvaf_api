<?php
namespace app\common\service;
use think\Db;
use think\Model;
use Naixiaoxin\ThinkWechat\Facade as WechatFacade;

/**
 * 微信相关的Service
 */
class WechatService extends Model{

    protected $payment;
    protected $miniProgram;
    protected $qiniuService;

    const API_BASE_URL_PREFIX = 'https://api.weixin.qq.com'; //以下API接口URL需要使用此前缀

    const OAUTH_TOKEN_URL = '/sns/oauth2/access_token?';

    const OAUTH_PREFIX = 'https://open.weixin.qq.com/connect/oauth2';

    const OAUTH_AUTHORIZE_URL = '/authorize?';

    public function __construct(){
        parent::__construct();
        $this->payment = WechatFacade::payment(config('wechat.status'));// 微信支付
        $this->miniProgram = WechatFacade::miniProgram(config('wechat.status')); // 小程序
        $this->mp = WechatFacade::officialAccount(config('wechat.status')); // 微信公众号
        $this->qiniuService = app('qiniuService');
    }



    /**
     * 获取微信公众号网页授权地址
     *
     * @param [type] $callback
     * @param string $state
     * @param string $scope
     * @return void
     */
    public function getOauthRedirect($callback, $state = '', $scope = 'snsapi_userinfo')
    {
        return self::OAUTH_PREFIX . self::OAUTH_AUTHORIZE_URL . 'appid=' . $this->mp['config']['app_id'] . '&redirect_uri=' . urlencode($callback) . '&response_type=code&scope=' . $scope . '&state=' . $state . '#wechat_redirect';
    }



    /**
     * 通过code获取Access Token
     * @return array {access_token,expires_in,refresh_token,openid,scope}
     */
    public function getOauthAccessToken($code = '')
    {
        $code = isset($_GET['code']) ? $_GET['code'] : $code;
        if (!$code) return false;
        $result = $this->http_get(self::API_BASE_URL_PREFIX . self::OAUTH_TOKEN_URL . 'appid=' . $this->appid . '&secret=' . $this->appsecret . '&code=' . $code . '&grant_type=authorization_code');
        return $result;
    }


    /**
     * 获取小程序session
     *
     * @param [type] $code
     * @return void
     */
    public function miniGetSession($code){
        return $this->miniProgram->auth->session($code);
    }


    public function getUserInfo($openid){
    }



    /**
     * 获取小程序码，并将图片上传到七牛云，同时返回图片链接
     *
     * @param [type] $path
     * @param integer $width
     * @param boolean $auto_color
     * @return void
     */
    public function getMiniCode($path, $width = 430, $auto_color = true){
        //$response = $this->miniProgram->app_code->get($path);
        $response = $this->miniProgram->app_code->get($path, [
            "width"=> $width,
            "auto_color"=> $auto_color,
            "line_color"=>["r"=>"0","g"=>"0","b"=>"0"]
        ]);
        // $response = $this->miniProgram->app_code->getUnlimit($scene, [
        //     "path"=> $path,
        //     "width"=>430,
        //     "auto_color"=>true,
        //     "line_color"=>["r"=>"0","g"=>"0","b"=>"0"]
        // ]);
        $save_path = PUBLIC_PATH . '/mini_qrcode/';
        $file_name = get_random(). '.png';
        $filename = $response->saveAs($save_path, $file_name);
        $file_path = $save_path. $filename;
        $upResult = $this->qiniuService->uploadOne($file_path, $filename);
        unlink($file_path);
        return array_key_exists('key',$upResult)
            ? ['file'=>$file_name,'upload'=>config('qiniu.domain').$upResult['key']]
            : ['file'=>$file_name,'upload'=>'failed'];
    }



    /**
     * 微信退款接口
     *
     * @param [type] $transactionId 微信订单号
     * @param [type] $refundNumber 商户退款单号
     * @param [type] $totalFee 订单金额： 单位：元
     * @param [type] $refundFee 退款金额：单位：元
     * @param [type] $refund_desc 退款理由
     * @return void
     */
    public function refundByTransactionId($transactionId, $refundNumber, $totalFee, $refundFee, $refund_desc){
        $config = array(
            'refund_desc' => $refund_desc
        );
        $totalFee = bcmul($totalFee, 100, 0);
        $refundFee = bcmul($refundFee, 100, 0);
        //return $this->payment->refund->byTransactionId($transactionId, $refundNumber, $totalFee, $refundFee, $config);
    }






    /**
     * GET 请求
     * @param string $url
     */
    private function http_get($url)
    {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 200) {
            return $sContent;
        } else {
            return false;
        }
    }

    /**
     * POST 请求
     * @param string $url
     * @param array $param
     * @param boolean $post_file 是否文件上传
     * @return string content
     */
    private function http_post($url, $param, $post_file = false)
    {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        if (PHP_VERSION_ID >= 50500 && class_exists('\CURLFile')) {
            $is_curlFile = true;
        } else {
            $is_curlFile = false;
            if (defined('CURLOPT_SAFE_UPLOAD')) {
                curl_setopt($oCurl, CURLOPT_SAFE_UPLOAD, false);
            }
        }
        if (is_string($param)) {
            $strPOST = $param;
        } elseif ($post_file) {
            if ($is_curlFile) {
                foreach ($param as $key => $val) {
                    if (substr($val, 0, 1) == '@') {
                        $param[$key] = new \CURLFile(realpath(substr($val, 1)));
                    }
                }
            }
            $strPOST = $param;
        } else {
            $aPOST = [];
            foreach ($param as $key => $val) {
                $aPOST[] = $key . "=" . urlencode($val);
            }
            $strPOST = join("&", $aPOST);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POST, true);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 200) {
            return $sContent;
        } else {
            return false;
        }
    }


}