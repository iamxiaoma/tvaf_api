<?php

namespace app\http\middleware;
use think\facade\Log;

class Api
{
    public function handle($request, \Closure $next)
    {
        try{
            $Origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : "*";

            // 设置支持跨域请求
            header('Access-Control-Max-Age:86400');
            header('Access-Control-Allow-Origin:'.$Origin);
            header('Access-Control-Allow-Credentials:true');
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            header("Access-Control-Allow-Headers: Token,Authorization,Content-Type,Accept,Origin,User-Agent,DNT,Cache-Control,X-Mx-ReqToken,Keep-Alive,X-Requested-With, If-Modified-Since, Last-Modified");
            // 中间件的前置行为
            // 配置跨域
            header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS, DELETE');
            if (strtoupper($_SERVER['REQUEST_METHOD']) == 'OPTIONS') {
                echo 'hello, this is a options request';
                exit;
            }
            //echo 'api 中间件前置动作，设置跨域配置等</br>';
            return $next($request);
        }catch(\Exception $e){
            // 如果是路由验证，默认返回的code为0，这里进行自定义
            $code = $e->getCode();
            $msg = $e->getMessage();
            if($code=== 0){
                $code = app('ErrCode')::PARAM_ERROR;
            }
            Log::record('errcode = '. $code.'，errmsg = '.$msg,'error');
            echo result_exception($code, $msg);
        }
    }
}
