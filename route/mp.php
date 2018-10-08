<?php
Route::group('mp', function () {

    // 不需要授权就可以访问的路由，放在这里
    Route::get('/', 'mp/Index/index');

    // 微信公众号网页授权跳转链接
    Route::get('/oauth', 'mp/Index/oauth')->validate('\app\common\validate\Wechat', 'oauth');

    // 微信公众号网页获取 jssdk 配置参数
    Route::get('/jssdk', 'mp/Index/jssdk')->validate('\app\common\validate\Wechat', 'jssdk');

    // 需要授权之后才能访问的路由，放到这个路由分组里面
    Route::group([], function(){

        // 在这里调用的路由，全部会经过中间件
        Route::get('/middleware', 'mp/Index/middleware');

    })->middleware('Mp');
    
})->middleware('Logger');