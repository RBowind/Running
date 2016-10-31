<?php
/**
 * Created by PhpStorm.
 * User: RBowi
 * * 参数： get:act
 *        POST:name，tel,age，introduce,school
 * 功能：实现用户信息的更新
 * 通过get方法传递act 的值 update 来实现相应的功能，post方法传递值，JSON格式，成功会返回200或传递的值，否则会报错。
 * POSTman 里面要用json格式发送请求，也就是 raw里面用JSON格式 ，而不是 x-www-form-urlencoded 格式。不然会有问题。
 * 根目录：??
 * Date: 2016/7/16
 * Time: 21:26
 */
require_once 'header.php';

$pdo = new PdoMySQL();

$account = $_SESSION['account'];


$act = $_GET['act'];

if ($act==='update'){
    try {
        $pdo -> update($_POST,'userinfo' ,'account ="'.$account.'"' );

        $result = json_encode($_POST);

        echo $result;

    }catch (PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
}