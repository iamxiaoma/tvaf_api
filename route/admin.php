<?php
Route::group('admin', function () {

    // 不需要授权就可以访问的路由，放在这里
    Route::get('/', 'admin/Index/index');

    // 需要授权之后才能访问的路由，放到这个路由分组里面
    Route::group([], function(){

        // 在这里调用的路由，全部会经过中间件
        Route::get('/middleware', 'admin/Index/middleware');

        // 后台管理员相关的路由
        Route::group('user', function(){
            Route::get('/list','admin/User/list');
            Route::get('/detail','admin/User/detail')->validate('\app\admin\validate\User', 'detail');
            Route::post('/edit','admin/User/edit')->validate('\app\admin\validate\User', 'edit');
            Route::post('/add','admin/User/add')->validate('\app\admin\validate\User', 'add');
            Route::post('/del','admin/User/del')->validate('\app\admin\validate\User', 'del');
        });

    })->middleware('Admin');
    
})->middleware('Logger');