<?php
namespace app\weapp\controller;

class Index
{
    public function index()
    {
        //exception('测试异常', 500);
        return 'tvaf weapp';
    }


    public function middleware(){
        // 获取中间件传入的参数
        return result('tvaf weapp middleware member_id = '. request()->member_id);
    }
}
