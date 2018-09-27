<?php

namespace app\http\middleware;

class Logger
{
    public function handle($request, \Closure $next)
    {
        echo 'Logger 日志中间件，可以记录请求的日志信息</br>';
        // 中间件的前置行为
        return $next($request);
    }
}
