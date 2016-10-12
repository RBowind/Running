<?php
/**
* Created by PhpStorm.
* User: RBowind
 * Date: 2016/8/28
 * Time: 11:29
 * 功能:各种查询。act通过get方法传递,记住：要登录！！！
 * eg:http://120.27.107.121/getinfo.php?act=getUserActivity   获得用户所有发布的活动以及详情
 * 1、 ***?act=getActivity&a_id=****   获得活动详情
 * 2、****?act=getThought$t_id=****    获得感想详情
 * 3、 ****?act=getUserThought         获得用户所有发布感想以及详情
 * 4、****?act=getRemark&r_id=***      获得评论详情
 * 5、****?act=getUserInfo&account=***            获得用户信息
 * 6、****?act=getActivityRemark&a_id=***     获得该活动所有评论
 *
 * 都会返回输出你要的数据 已经json化 200ok
 */
require_once 'header.php';
/*
if(!isset($_SESSION['account']))
{
    exit("请注册或登录");
}*/

$GLOBALS['pdo'] = new PdoMySQL();


    class getActivity     //根据 活动ID 得到活动详情
    {

        public function getActivity()
        {
            try{
               if($array = $GLOBALS['pdo'] ->find('activity',"a_id = '".$_GET['a_id']."'"))
               {
                   JsonEcho($array);
               }

            }catch (PDOException $e){
                echo '查询失败，请稍后重试。';
            }
        }



    }
    class getUserActivity
    {
        public $pagesize = 5 ;   //定义每页数量

        public function getUserActivitity()
        {

            $a_id = $GLOBALS['pdo'] ->find('user_activity',"account = '".$_SESSION['account']."'",'a_id');
            //得到页数 n
            $pages = intval(count($a_id)/$this->pagesize);

            //判断当前页数
            $nowpage = isset($_GET['page'])?intval($_GET['page']) : 1;

            //偏移量
            $this->offset = ($nowpage-1)*$this->pagesize;

            try
            {
                if($a_ids = $GLOBALS['pdo'] ->find('user_activity',"account = '".$_SESSION['account']."'",'a_id',null,null,'time desc',"$this->offset,$this->pagesize"))
                {
                    $array =array(
                        'array' => array()
                    );

                    //当用户发布的活动只有1条时，$a_ids["$i"]['a_id']取值会出现bug，所以分类对待。但是影响速度啊。。。
                    if (count($a_ids)==1)
                    {
                        $user_Activities = $GLOBALS['pdo'] ->find('activity',"a_id = '".$a_ids['a_id']."'") ;
                        array_push($array['array'],$user_Activities);
                        echo json_encode($array);
                    }else {
                        for ($i=0;$i<count($a_ids);$i++)
                        {
                            $user_Activities = $GLOBALS['pdo'] ->find('activity',"a_id = '".$a_ids["$i"]['a_id']."'") ;
                            array_push($array['array'],$user_Activities);
                        }
                        echo json_encode($array);
                    }
                }
            }catch (PDOException $e){
                echo '查询失败，请稍后重试。';
            }
        }
        public function getActivityRemark()
        {
            try{
                $a_id = $_GET['a_id'];
                $sql = "SELECT * FROM remark WHERE a_id='$a_id' ";

                //count($row)是查询得到的数目
                $row =$GLOBALS['pdo']->getAll($sql);


                if ($allremark = $GLOBALS['pdo']->find('remark',"a_id = '" . $_GET ['a_id'] . "'"))
                {
                    $array =array(
                        'array' => array()
                    );

                    for($i=0;$i<count($row);$i++){
                        array_push($array['array'],$allremark[$i]);
                    }

                    echo json_encode($array);

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

                if($array = $GLOBALS['pdo'] ->find('thought',"t_id = '".$_GET['t_id']."'"))
                {
                    JsonEcho($array);
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
                if($thought = $GLOBALS['pdo'] ->find('thought',"account = '".$_SESSION['account']."'"))
                {
                    $array =array(
                        'array' => array()
                    );

                    for($i=0;$i<count($thought);$i++){
                        array_push($array['array'],$thought[$i]);
                    }

                    echo json_encode($array);

                }




            }catch (PDOException $e){
                echo '查询失败，请稍后重试。';
            }
        }
    }

    class getRemark                 //根据 评论ID 得到评论详情
    {

        public function getOneRemark()
        {
            try {
                if($remark = $GLOBALS['pdo']->find('remark', "r_id = '" . $_GET ['r_id'] . "'"))
                {
                    JsonEcho($remark);
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
                if($userInfo = $GLOBALS['pdo'] ->find('userinfo',"account = '".$_GET['account']."'"))
                {
                    JsonEcho($userInfo);
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
        case "getActivityRemark":
            $getActivityRemark = new getUserActivity();
            $getActivityRemark->getActivityRemark();
            break;
        case "getThought":
            $getThought = new getThought();
            break;
        case "getUserThought":
            $getUserThought = new getUserThought();
            $getUserThought ->getUserThoughts();
            break;
        case "getRemark":
            $getRemark = new getRemark();
            $getRemark->getOneRemark();
            break;
        case "getUserInfo":
            $getUserInfo = new getUserInfo();
            break;

    }

