<?php

/**
 * Created by PhpStorm.
 * User: RBowi
 * Date: 2016/7/28
 * 功能：实现发起活动、 删除活动，
 * 注意：此功能必须得先登录成功来保持session。
 *通过get方法传递 act的值postActivity，内容用JSON格式，传递的活动信息用post方法：
 * 'postTime'=> $_POST['postTime'],
    'route'=>$_POST['route'],
    'address'=>$_POST['address'],
    'p_number'=> $_POST['p_number'],
    'distance'=>$_POST['distance'],
    'description'=>$_POST['description'],
    'toAccount'=>$_POST['toAccount'],
    'runtime'=>$_POST['runtime']
 * 成功返回活动信息 json 化。200.
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
    public $time;

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        date_default_timezone_set('Asia/Shanghai');
        $time=date("Y-m-d H:i:s");
        $this->time = $time;
        return $this->time;
    }

    public function setAId($a_id)
    {

        $this->a_id =$_SESSION['account'].time();
        return $this->a_id;
    }

    public function setPhotoUrl($photoUrl)
    {
        $pdox = new PdoMySQL();
        $account = $_SESSION['account'];
        $sql = "SELECT photo FROM userinfo WHERE account ='$account'";
        $photo = $pdox -> getrow($sql);
        $this->photoUrl = $photoUrl =$photo['photo'];
        return $this->photoUrl;
    }


    public function postActivity()
    {
        $pdo = new PdoMySQL();
        $data = array(
            'a_id' => self::setAId($this->a_id) ,
            'account' => $_SESSION['account'],
            'postTime'=> $_POST['postTime'],
            'route'=>$_POST['route'],
            'address'=>$_POST['address'],
            'p_number'=> $_POST['p_number'],
            'distance'=>$_POST['distance'],
            'description'=>$_POST['description'],
            'toAccount'=>$_POST['toAccount'],
            'runtime'=>$_POST['runtime'],
            'time'=>self::setTime($this->time),
            'photo' => self::setPhotoUrl($this->photoUrl)
        );
        $pdo -> add($data,'activity');
        var_dump($data);
    }
}
class deleteActivity
{
    public function delectActivity()
    {
        $pdo2 = new PdoMySQL();
        $data = array(
          'cancel' => 1
        );
        if($pdo2 ->update($data,'activity',"a_id='".$_GET['a_id']."'"))
        {

            /*$pdo2 ->delete('user_activity',"a_id='".$_GET['a_id']."'");
            echo true;
            if($pdo2 -> delete('remark',"a_id='".$_GET['a_id']."'")){
                echo true;
            }
            */

           /*
          Coding...
          提示参加活动的用户 该活动已经取消
           */
            echo true;
            header("Location: cancelEvent.php?a_id=".$_GET['a_id']."");
        }else{
            echo 0;
        }
    }
}
class adduseractivity extends activity
{
        public function addactivity()
        {
            $pdo1 = new PdoMySQL();
            $userActivity = array(
                'account'=>$_SESSION['account'],
                'a_id' => self::setAId($this->a_id),
                'time'=>self::setTime($this->time)
            );
            $pdo1 -> add($userActivity,'user_activity');
            $pdo1 -> add($userActivity,'joinactivity');

            var_dump($userActivity);
        }

}

    @$act = $_GET['act'];

    if ($act ==='postActivity')
    {
        try
        {

            $user_activity = new adduseractivity();
            $postActivity = new activity();
            $postActivity->postActivity();
            $user_activity->addactivity() ;


        }catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }else{
        try{
            $deleteActivity = new deleteActivity();
            $deleteActivity ->delectActivity();
        }catch (PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }

    }