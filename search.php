<?php
/**
 * Created by PhpStorm.
 * User: RBowind
 * * 参数： get:account=$account 把用户名用get方法 account的值来传递
 * 功能：实现查询用户是否存在
 * 通过get方法传递account 的值 account 来查询用户是否存在。
 * 若存在：返回 "wrong": "The account has been registered";
 * 不存在，返回 布尔值 true；也就是 1,也就是这种情况可以注册。
 *
 * Date: 2016/7/12
 * Time: 10:00
 */

require_once 'header.php';

    $account = $_GET['account'];
    $pdo = new PdoMySQL();
    try {
        if($pdo -> find('user','account = "'.$account.'"'))
        {
            $result = [
                'wrong' => "The account has been registered"
            ];
            echo json_encode($result);
        }else{
            echo true ;

        }

    }catch (PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
