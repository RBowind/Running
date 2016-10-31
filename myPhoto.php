<?php
/**
 * Created by 赵天歌 on 2016/10/31.
 * Time: 21:50
 * 已经登录的用户可以根据session得到用户图像路径的返回。
 */
require_once 'header.php';
$account = $_SESSION['account'];
$pdo = new PdoMySQL();
$photo = $pdo->find('userinfo',"account= '$account' ",'photo');
echo JsonEcho($photo);