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

    public function __construct(){
        parent::__construct();
        $this->payment = WechatFacade::payment(config('wechat.status'));// 微信支付
        $this->miniProgram = WechatFacade::miniProgram(config('wechat.status')); // 小程序
        $this->mp = WechatFacade::officialAccount(config('wechat.status')); // 微信公众号
        $this->qiniuService = app('qiniuService');
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

}