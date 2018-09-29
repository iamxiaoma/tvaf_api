<?php

namespace app\http\middleware;

class WWW
{
    public function handle($request, \Closure $next)
    {
        echo 'www 中间件前置动作，可以进行身份认证等动作</br>';
        // 中间件的前置行为
        return $next($request);
    }
}
