<?php
namespace app\common\enum;

/**
 * 接口返回代码常量
 */
class ErrCode {

    const SYS_ERR = -1; // 系统内部错误

    const OK = 200; // 正常返回

    const FAIL = 500; // 请求出错

    const ACCOUNT_ERROR = 40001; // 获取 token 的账号密码错误

    const UNAUTHORIZED = 40002; // 未授权，即没有传 token

    const TOKEN_ERROR = 40003; // Token 格式不正确

    const TOKEN_EXPIRES = 40004; // 授权过期

    const CODE_BEEN_USED = 40005; // Code 已使用

    const INVALID_CODE = 40006; // 无效 Code

    const WEAPP_ERROR = 40007; // 小程序接口报错

    const ROUTE_ERROR = 50001; // 请求路由错误

    const PARAM_ERROR = 50002; // 参数错误

    const SQL_ERROR = 50003; // SQL错误

    const MISSING_UPLOAD_FILE = 50004; // 上传文件缺失

    const UPLOAD_ERROR = 50005; // 上传失败

    const REMOTE_SERVICE_ERROR = 50006; // 远端服务不可用

    const ILLEGAL_FILE_TYPE = 50007; // 不合法的文件类型

    const ILLEGAL_FILE_SIZE = 50008; // 不合法的文件大小

    const INVALID_VERIFY_CODE = 50009; // 验证码错误

    
}