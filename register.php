<?php
/**
 * Created by PhpStorm.
 * User: RBowind
 * Date: 2016/7/3
 * Time: 20:59
 * 参数： get:act
 *       post :account ，password
 * 功能：实现用户的 注册 、登录、注销
 * 通过get方法传递act 的值 register 、login、exit来实现相应的功能，post方法传递值，JSON格式，成功会返回200或传递的值，否则会报错。
 * POSTman 里面要用json格式发送请求，也就是 raw里面用JSON格式 ，而不是 x-www-form-urlencoded 格式。不然会有问题。
 * 
 */
require_once 'header.php';

$pdo = new PdoMySQL();

$act = $_GET['act'];

$account = addslashes($_POST['account']);

$password = md5($_POST['password']);

    if  ($act ==='register') {
        try {
            $data = array(
                'account' => "$account",
                'password' => "$password",
            );

            if($pdo->add($data, 'user')){

                $result = true;


                $_SESSION['account'] = $account;

                return $result;

            }

            } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
            }
    }

    if  ($act ==='login'){

        try {

            if( $passwd = $pdo->find('user',' account =  "'.$account.'" ','password')){
                    if($password == $passwd['password'] ){

                        $_SESSION['account'] = $account;

                        echo true;

                        return true;

                    }else{

                        echo '密码错误';
                    }
            }else{

                    echo false;

                    echo "用户名不存在";

                    return false;

                }
        }catch (PDOException $e){

            echo $sql . "<br>" . $e->getMessage();
        }

    }

    if ($act ==='exit') {
        unset($_SESSION['account']);
        echo '注销成功 ';
    }

