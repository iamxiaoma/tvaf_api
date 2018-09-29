<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


/**
 * 自定义数据返回方法
 *
 * @param [type] $data
 * @param integer $errcode
 * @param string $errmsg
 * @return void
 */
function result($data)
{
    $return = [
        "data"=>  $data,
        "errcode"=> app('ErrCode')::OK,
        "errmsg"=> 'ok'
    ];
    // 添加JSON_UNESCAPED_UNICODE参数，注意必须是php5.4以后的版本才可以使用。解决中文转码的问题
    exit(json_encode($return, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE));
}


/**
 * 自定义异常返回方法
 *
 * @param integer $errcode
 * @param string $errmsg
 * @return void
 */
function result_exception($errcode, $errmsg = 'failed')
{
    $return = [
        "data"=>  '',
        "errcode"=> $errcode,
        "errmsg"=> $errmsg
    ];
    // 添加JSON_UNESCAPED_UNICODE参数，注意必须是php5.4以后的版本才可以使用。解决中文转码的问题
    exit(json_encode($return, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE));
}


/**
 * 生成随机字符串
 * @param string $prefix
 * @return string
 */
function get_random($prefix = '') {
    return $prefix . base_convert(time() * 1000, 10, 36) . "_" . base_convert(microtime(), 10, 36) . uniqid();
}


function p($input){
    if(is_array($input)){
        echo '<pre>';
        print_r($input);
    }else if(gettype($input) == 'object'){
        var_dump(json_encode($input));
    }else{
        var_dump($input);
    }
}


/**
 * 获取当前时间
 * @return [type] [description]
 */
function now() {
	return date('Y-m-d H:i:s');
}


/**
 * 获取毫秒数
 * @return [type] [description]
 */
function millisecond() {
	list($s1, $s2) = explode(' ', microtime());
	return (float) sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
}