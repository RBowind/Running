<?php

/**
 * Created by PhpStorm.
 * User: RBowi
 * Date: 2016/7/28
 * 功能：实现发起活动、 删除活动，回复活动，参加活动
 * 注意：此功能必须得先登录成功来保持session。
 *通过get方法传递 act的值postActivity，内容用JSON格式，传递的活动信息用post方法：
 * 'postTime'=> $_POST['postTime'],
    'route'=>$_POST['route'],
    'address'=>$_POST['address'],
    'p_number'=> $_POST['p_number'],
    'distance'=>$_POST['distance'],
    'description'=>$_POST['description'],
    '@account'=>$_POST['@account'],
    'runtime'=>$_POST['runtime']
 * 成功返回活动信息。200.
 * Time: 17:03
 */
require_once 'header.php';

if(!isset($_SESSION['account']))
{
    exit("请注册或登录！");
}

class activity
{

    public  $a_id ;

    public function setAId($a_id)
    {
        date_default_timezone_set('Asia/Shanghai');
         $time=date("Y-m-d H:i:s");
        $this->a_id =$_SESSION['account'].$time;
        return $this->a_id;
    }



    public function postActivity(){
        $pdo = new PdoMySQL();
        $data = array(
            'a_id' => self::setAId($this->a_id) ,
            'postTime'=> $_POST['postTime'],
            'route'=>$_POST['route'],
            'address'=>$_POST['address'],
            'p_number'=> $_POST['p_number'],
            'distance'=>$_POST['distance'],
            'description'=>$_POST['description'],
            '@account'=>$_POST['@account'],
            'runtime'=>$_POST['runtime']
        );
        $pdo -> add($data,'activity');
        var_dump($data);
    }
}
class adduseractivity extends activity
{
        public function addactivity()
        {
            $pdo1 = new PdoMySQL();
            $userActivity = array(
                'account'=>$_SESSION['account'],
                'a_id' => self::setAId($this->a_id)
            );
            $pdo1 -> add($userActivity,'user_activity');
            var_dump($userActivity);
        }
}

    $act = $_GET['act'];

    if ($act ==='postActivity')
    {
        try
        {
            $user_activity = new adduseractivity();
            $user_activity->addactivity();
            $postActivity = new activity();
            $postActivity->postActivity();
        }catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }