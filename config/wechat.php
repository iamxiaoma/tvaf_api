<?php
/**
 * 配置文件
 *
 * @author 耐小心<i@naixiaoxin.com>
 * @copyright 2017-2018 耐小心
 */

return [

    'status' => 'default',   // 开启的状态， default 为 开发用的
    /*
      * 默认配置，将会合并到各模块中
      */
    'defaults'         => [
        /*
         * 指定 API 调用返回结果的类型：array(default)/object/raw/自定义类名
         */
        'response_type' => 'array',
        /*
         * 使用 ThinkPHP 的缓存系统
         */
        'use_tp_cache'  => true,
        /*
         * 日志配置
         *
         * level: 日志级别，可选为：
         *                 debug/info/notice/warning/error/critical/alert/emergency
         * file：日志文件位置(绝对路径!!!)，要求可写权限
         */
        'log'           => [
            'level' => env('WECHAT_LOG_LEVEL', 'debug'),
            'file'  => env('WECHAT_LOG_FILE', ('logs/wechat.log')),
        ],
    ],

    //公众号
    'official_account' => [
        'default' => [
            // AppID
            'app_id' => env('WECHAT_OFFICIAL_ACCOUNT_APPID', 'wx50a5bdbe84de8380'),
            // AppSecret
            'secret' => env('WECHAT_OFFICIAL_ACCOUNT_SECRET', '6ddc4f728e571896a8fa2af783c7d7b7'),
            // Token
            'token' => env('WECHAT_OFFICIAL_ACCOUNT_TOKEN', 'your-token'),
            // EncodingAESKey
            'aes_key' => env('WECHAT_OFFICIAL_ACCOUNT_AES_KEY', ''),
            /*
             * OAuth 配置
             *
             * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
             * callback：OAuth授权完成后的回调页地址(如果使用中间件，则随便填写。。。)
             */
            //'oauth' => [
            //    'scopes'   => array_map('trim',
            //        explode(',', env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_SCOPES', 'snsapi_userinfo'))),
            //    'callback' => env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_CALLBACK', '/examples/oauth_callback.php'),
            //],
        ],
    ],

    //第三方开发平台
    //'open_platform'    => [
    //    'default' => [
    //        'app_id'  => env('WECHAT_OPEN_PLATFORM_APPID', ''),
    //        'secret'  => env('WECHAT_OPEN_PLATFORM_SECRET', ''),
    //        'token'   => env('WECHAT_OPEN_PLATFORM_TOKEN', ''),
    //        'aes_key' => env('WECHAT_OPEN_PLATFORM_AES_KEY', ''),
    //    ],
    //],

    //小程序
    'mini_program'     => [
       'default' => [
           'app_id'  => env('WECHAT_MINI_PROGRAM_APPID', 'wx4fa08867293e3e04'),
           'secret'  => env('WECHAT_MINI_PROGRAM_SECRET', '25a36a50773ff768df4974ecca1167b4'),
           'token'   => env('WECHAT_MINI_PROGRAM_TOKEN', ''),
           'aes_key' => env('WECHAT_MINI_PROGRAM_AES_KEY', ''),
       ],
    ],

    //支付
    'payment'          => [
       'default' => [
           'sandbox'    => env('WECHAT_PAYMENT_SANDBOX', false),
           'app_id'     => env('WECHAT_PAYMENT_APPID', 'wx4fa08867293e3e04'),
           'mch_id'     => env('WECHAT_PAYMENT_MCH_ID', '1410124702'),
           'key'        => env('WECHAT_PAYMENT_KEY', 'YJEMfLmVKcWuHNfzFg7046nZ6YFdOR7N'),
           'cert_path'  => env('WECHAT_PAYMENT_CERT_PATH', __DIR__.DIRECTORY_SEPARATOR.'cert'.DIRECTORY_SEPARATOR.'dev'.DIRECTORY_SEPARATOR.'apiclient_cert.pem'),    // XXX: 绝对路径！！！！
           'key_path'   => env('WECHAT_PAYMENT_KEY_PATH', __DIR__.DIRECTORY_SEPARATOR.'cert'.DIRECTORY_SEPARATOR.'dev'.DIRECTORY_SEPARATOR.'apiclient_key.pem'),      // XXX: 绝对路径！！！！
           'notify_url' => 'mini.'. env('url_domain_root'). 'notify/mini_pay',                           // 默认支付结果通知地址
       ],
       // ...
    ],

    //企业微信
    //'work'             => [
    //    'default' => [
    //        'corp_id'  => 'xxxxxxxxxxxxxxxxx',
    //        'agent_id' => 100020,
    //        'secret'   => env('WECHAT_WORK_AGENT_CONTACTS_SECRET', ''),
    //        //...
    //    ],
    //],
];
