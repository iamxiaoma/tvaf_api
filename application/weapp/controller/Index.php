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
        return result('tvaf weapp middleware');
    }
}
