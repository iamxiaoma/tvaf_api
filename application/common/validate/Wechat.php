<?php
namespace app\common\validate;

use think\Validate;


class Wechat extends Validate{


    protected $rule = [
        'url' => 'require',
    ];

    protected $message = [
        'url.require' => 'url必填',
    ];

    protected $scene = [
        'oauth' => ['url'],
        'jssdk' => ['url'],
    ];
}