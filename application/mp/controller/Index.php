<?php
namespace app\mp\controller;

class Index
{
    public function index()
    {
        return result('hello tvaf mp');
    }


    public function oauth(){
        return result(app('wechatService')->getOauthRedirect(input('param.url')));
    }


    public function jssdk(){
        return result(app('wechatService')->getJSSDK(input('param.url')));
    }
}
