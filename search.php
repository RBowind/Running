<?php
/**
 * Created by PhpStorm.
 * User: RBowi
 * * 参数： get:act
 * 功能：实现查询用户是否存在
 * 通过get方法传递act 的值 account 来实现相应的功能，post方法传递值，JSON格式，成功会返回200或传递的值，否则会报错。

 * 根目录： 121.42.162.214/RunningTogether/
 * Date: 2016/7/12
 * Time: 10:00
 */

require_once 'header.php';

    $account = $_GET['account'];
    $pdo = new PdoMySQL();
    $tables = 'user';

    try {
        if($pdo -> find($tables,"account = '.$account.'")){
            echo true;
        }else{
            echo false;
            echo "用户不存在";
        }

    }catch (PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
