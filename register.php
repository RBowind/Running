<?php
/**
 * Created by PhpStorm.
 * User: RBowind
 * Date: 2016/7/3
 * Time: 20:59
 * 参数： get:act
 *       post :account ，password
 * 功能：实现用户的 注册 、登录、注销
 * 通过get方法传递act 的值 register 、login、exit来实现相应的功能，post方法传递值，JSON格式：
 * {
"account":"admn",
"password":"admin"
}
 * 成功会返回200以及 相应的内容（register successfull $account/hello $account），否则返回wrong password 或者 this account is Not exist。
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

                $_SESSION['account'] = $account;

                $result = [
                    '1' => "register successfully!",
                    '2' => $account
                ];
		echo true;
                echo json_encode($result);
		header("Location: userinfo.php");

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

                        $result = [
                            '1' => "hello",
                            '2' => $account
                        ];
			echo true;
                        echo json_encode($result);
                        echo $_SESSION['account'];

                    }else{

                        $result1 = [
                            'wrong1' => "Wrong Password!"

                        ];
			echo 0;
                       echo json_encode($result1);

                    }
            }else{

                $result2 = [
                    'wrong2'=>"This account is Not exist!"
                ];
		echo 0;
                echo json_encode($result2);


                }
        }catch (PDOException $e){

            echo $sql . "<br>" . $e->getMessage();
        }

    }

    if ($act ==='exit') {
        unset($_SESSION['account']);
        echo '注销成功 ';
    }

