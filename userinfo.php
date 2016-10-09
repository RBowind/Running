<?php
/**
 * Created by PhpStorm.
 * User: RBowind
 * 参数： get:act
 *        POST:name，tel,age，introduce,school
 * 功能：实现用户信息的添加
 * 通过get方法传递act 的值 addinfo 来实现相应的功能，post方法传递值，JSON格式，成功会返回200或传递的值，否则会报错。
 * POSTman 里面要用json格式发送请求，也就是 raw里面用JSON格式 ，而不是 x-www-form-urlencoded 格式。不然会有问题。
 * 根目录： 121.42.162.214/RunningTogether/
 * Date: 2016/7/16
 * Time: 20:13
 */
require_once 'header.php';

$pdo = new PdoMySQL();

$act = $_GET['act'];

/*$account = $_SESSION['account'];
$name = $_POST['name'];
$tel = $_POST['tel'];
$age = $_POST['age'];
$introduce = $_POST['introduce'];
$school = $_POST['school'];*/

$_POST['account'] = $_SESSION['account'];

    if ($_POST['account']){
        try {
            $pdo ->add( $_POST,'userinfo');

            $result = json_encode($_POST);

            echo $result;

        }catch (PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
    }
