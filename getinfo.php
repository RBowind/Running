<?php
/**
* Created by PhpStorm.
* User: RBowind
 * Date: 2016/8/28
 * Time: 11:29
 */
require_once 'header.php';

if(!isset($_SESSION['account']))
{
    exit("请注册或登录");
}

$GLOBALS['pdo'] = new PdoMySQL();


    class getActivity     //根据 活动ID 得到活动详情
    {

        public function getActivity()
        {
            try{
                $array = $GLOBALS['pdo'] ->find('activity',"a_id = '".$_GET['a_id']."'") ;
                foreach ($array as $key=>$value){
                    echo $key.' : '.$value."<br/>";
                }
            }catch (PDOException $e){
                echo '查询失败，请稍后重试。';
            }
        }



    }
    class getUserActivity
    {
        public function getUserActivitity()
        {
            try{
                if($a_ids = $GLOBALS['pdo'] ->find('user_activity',"account = '".$_SESSION['account']."'",'a_id'))
                {

                    for ($i =0;$i<count($a_ids);$i++){
                        $user_Activities = $GLOBALS['pdo'] ->find('activity',"a_id = '".$a_ids["$i"]['a_id']."'") ;
                        print_r($user_Activities);
                        echo "<br>";

                    }
                }
            }catch (PDOException $e){
                echo '查询失败，请稍后重试。';
            }
        }
    }


    class getThought        //根据感想ID得到感想详情
    {
        public function getThought()
        {
            try{
                $array = $GLOBALS['pdo'] ->find('thought',"t_id = '".$_GET['t_id']."'") ;
                foreach ($array as $key=>$value){
                    echo $key.' : '.$value."<br/>";
                }
            }catch (PDOException $e){
                echo '查询失败，请稍后重试。';
            }
        }


    }
    class getUserThought
    {
        public function getUserThoughts()
        {
            try{
                $array = $GLOBALS['pdo'] ->find('user_thought',"t_id = '".$_GET['t_id']."'") ;
                foreach ($array as $key=>$value){
                    echo $key.' : '.$value."<br/>";
                }
            }catch (PDOException $e){
                echo '查询失败，请稍后重试。';
            }
        }
    }

    class getRemark                 //根据 评论ID 得到评论详情
    {

        public function getRemark()
        {
            try {
                $array = $GLOBALS['pdo']->find('remark', "r_id = '" . $_GET ['r_id'] . "'");
                foreach ($array as $key => $value) {
                    echo $key . ' : ' . $value . "<br/>";
                }
            }catch (PDOException $e){
                echo '查询失败，请稍后重试。';
            }
        }
    }

    class getUserInfo       //根据用户名得到用户信息详情
    {

        public function getUserInfo()
        {
            try{
                $array = $GLOBALS['pdo'] ->find('userinfo',"account = '".$_SESSION['account']."'") ;
                foreach ($array as $key => $value) {
                    echo $key . ' : ' . $value . "<br/>";
                }
            }catch (PDOException $e){
                echo '查询失败，请稍后重试。';
            }
        }
    }

    $act = $_GET['act'];
    switch ($act)
    {
        case "getActivity":
            $getActivity = new getActivity();
            break;
        case "getUserActivity":
            $getUserActivity = new getUserActivity();
            $getUserActivity->getUserActivitity();
            break;
        case "getThought":
            $getThought = new getThought();
            break;
        case "getUserThought":
            $getUserThought = new getUserThought();
            break;
        case "getRemark":
            $getRemark = new getRemark();
            break;
        case "getUserInfo":
            $getUserInfo = new getUserInfo();
            break;
    }

