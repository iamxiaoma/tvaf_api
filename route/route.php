<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// blog子域名绑定到blog模块
// Route::domain('blog', 'blog');

// // 完整域名绑定到admin模块
// Route::domain('admin.thinkphp.cn', 'admin');

// // IP绑定到admin模块
// Route::domain('114.23.4.5', 'admin');

Route::rule('/', 'index/Index/index');
Route::miss('index/miss');

// 全局路由参数
// Route::option('ext','html')->option('cache', 600);
