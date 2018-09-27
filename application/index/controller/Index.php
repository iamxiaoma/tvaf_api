<?php
namespace app\index\controller;

class Index
{
    public function index()
    {
        return 'hello tvaf api';
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }

    public function miss(){
        exception('请求的路由不存在', 500);
    }
}
