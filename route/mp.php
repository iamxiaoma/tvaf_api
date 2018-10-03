<?php
Route::group('mp', function () {

    // 不需要授权就可以访问的路由，放在这里
    Route::get('/', 'mp/Index/index');

    Route::get('/oauth', 'mp/Index/oauth');

    // 需要授权之后才能访问的路由，放到这个路由分组里面
    Route::group([], function(){

        // 在这里调用的路由，全部会经过中间件
        Route::get('/middleware', 'mp/Index/middleware');

    })->middleware('Mp');
    
})->middleware('Logger');