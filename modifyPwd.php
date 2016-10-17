<?php
/**
 * Created by 赵天歌 on 2016/10/16.
 * Time: 22:15
 * http://localhost/running/modifyPwd.php?act=modifyPwd
 * post 的两个值： $_POST['oldPassword'] and $_POST['newPassword']
 * 新密码 一般都是输入两次验证相同，这个在前端解决下就好，所以我这里就只接收 新旧 两个值 。
 * 修改成功返回 1，否则返回 0 。
 */


require_once 'header.php';

$pdo = new PdoMySQL();

$act = $_GET['act'];

$account = $_SESSION['account'];

$oldPassword = md5($_POST['oldPassword']);

$newPassword = md5($_POST['newPassword']);

if ($act === 'modifyPwd'){
    try{
        $data = array(
          'password' => $newPassword
        );

        if ($password = $pdo -> find('user','account ="'.$account.'"','password')){
            if($oldPassword == $password['password'] && $pdo -> update($data,'user','account ="'.$account.'"')){
                   echo true;
            }else{
                echo 0;
            }
        }
    }catch (PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
}