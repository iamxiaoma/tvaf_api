<?php
namespace app\index\controller;
class Index
{
    public function index()
    {
        return 'hello tvaf api ·12·12·1';
    }

    public function miss(){
        exception('请求的路由不存在', app('ErrCode')::PARAM_ERROR);
    }
}
