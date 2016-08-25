<?php
/**
 * Created by PhpStorm.
 * User: 赵天歌
 * Date: 2016/8/19
 * Time: 0:33
 *功能：实现发布感想的功能。此功能也必须先登录来保持session。
 */
    require_once 'header.php';
    if(!isset($_SESSION['account']))
    {
    	exit("请注册或登录");
    }


    


   

