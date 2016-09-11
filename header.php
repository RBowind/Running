<?php
/**
 * Created by PhpStorm.
 * User: RBowi
 * Date: 2016/7/16
 * Time: 20:14
 */

require_once 'PdoMySQL.class.php';
require_once 'config.php';

session_start();
header('content-type:text/json;charset=utf-8');
header('Access-Control-Allow-Headers: "Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"');
//将post提交的格式转化为JSON格式
$postJson = file_get_contents('php://input');
$_POST = json_decode($postJson, true);

// 封装了 解决json输出中文乱码的问题的方法。仅适用于一维数组。
function JsonEcho($array){
    foreach ( $array as $key => $value ) {
        $array[$key] = urlencode ( $value );
    }
    echo  urldecode (json_encode ($array ));
}

/*function Json($array){
    foreach ( $array as $key => $value ) {
        $array[$key] = urlencode ( $value );
    }
       urldecode (json_encode ($array ));
}*/


