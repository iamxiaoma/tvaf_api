<?php

namespace app\http\middleware;

class Api
{
    public function handle($request, \Closure $next)
    {
        echo 'api 中间件前置动作，设置跨域配置等</br>';
        // 中间件的前置行为
        return $next($request);
    }
}
