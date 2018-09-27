# tvaf_api
tvaf体系的api接口部分

基于 ThinkPHP 5.1.24 开发的 API 接口服务架构

请先安装 composer

使用 composer 安装 ThinkPHP 及其依赖项

Mac 进入到项目根目录下执行以下命令
composer install


执行以下命令，更新依赖项到最新版本
composer update

可以使用 ThinkPHP 内置服务器启动

命令行切换到应用根目录后，输入（MacOS需要加 sudo ）：

> >php think run

如果启动成功，会输出下面信息，并显示web目录位置。

ThinkPHP Development server is started On <http://127.0.0.1:8000/>
You can exit with `CTRL-C`
Document root is: D:\WWW\tp5/public

然后你可以直接在浏览器里面访问

http://127.0.0.1:8000/

详细操作参考官方文档
https://www.kancloud.cn/manual/thinkphp5_1/518750

### 示例请求：

http://127.0.0.1:8000/app
http://127.0.0.1:8000/app/middleware

http://127.0.0.1:8000/www
http://127.0.0.1:8000/www/middleware

http://127.0.0.1:8000/admin/
http://127.0.0.1:8000/admin/middleware

http://127.0.0.1:8000/weapp
http://127.0.0.1:8000/weapp/middleware


### 功能模块

1、路由
2、中间件
3、日志管理
