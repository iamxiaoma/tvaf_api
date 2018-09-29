<?php
Route::group('weapp', function () {

    // 不需要授权就可以访问的路由，放在这里
    Route::get('/', 'weapp/Index/index');

    // 小程序登录
    Route::get('/login', 'weapp/Login/login')->validate('\app\common\validate\Member', 'weapp_login');

    // 发送短信验证码
    Route::post('/sms_send', 'weapp/Login/sms_send')->validate('app\common\validate\Member', 'sms_send');

    // 小程序绑定手机号码
    Route::post('/bind', 'weapp/Login/bind')->validate('\app\common\validate\Member', 'weapp_bind');

    // 需要授权之后才能访问的路由，放到这个路由分组里面
    Route::group([], function(){

        // 在这里调用的路由，全部会经过中间件
        Route::get('/middleware', 'weapp/Index/middleware');

    })->middleware('Weapp');
    
})->middleware('Logger');