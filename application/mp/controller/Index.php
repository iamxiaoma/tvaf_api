<?php
namespace app\mp\controller;

class Index
{
    public function index()
    {
        return result('hello tvaf mp');
    }


    public function oauth(){
        return result(app('wechatService')->getOauthRedirect('http://h5.xcourage.fullstack.cn'));
    }
}
