<?php
namespace app\weapp\controller;

class Login{


    /**
     * 小程序登录
     *
     * @return void
     */
    public function login(){
        return result(app('loginService')->weapp(input('')));
    }


    public function sms_send(){
        return result(app('smsService')->send(input('param.region'), input('param.mobile')));
    }


    /**
     * 小程序绑定手机号码
     *
     * @return void
     */
    public function bind(){
        return result(app('accountService')->weapp_bind(input('')));
    }

}