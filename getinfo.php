<?php
/**
* Created by PhpStorm.
* User: RBowind
 * Date: 2016/8/28
 * Time: 11:29
 */
require_once 'header.php';
$act = $_GET['act'];

$GLOBALS['pdo'] = new PdoMySQL();


    class getActivity     //根据 活动ID 得到活动详情
    {
        public $a_id;

        /**
         * @param mixed $a_id
         */
        public function setAId($a_id)
        {
            $a_id = $_GET['a_id'];
            return $this->a_id = $a_id;
        }

        public function getActivity()
        {
            try{
                $array = $GLOBALS['pdo'] ->find('activity',"a_id = '.$this->a_id.'") ;
            }catch (PDOException $e){
                echo '查询失败，请稍后重试。';
            }
        }

        public function getUserActivities()
        {

        }

    }

    class getThought        //根据感想ID得到感想详情
    {
        public $t_id ;

        /**
         * @param mixed $t_id
         */
        public function setTId($t_id)
        {
            $t_id = $_GET['t_id'];
            return $this->t_id = $t_id;
        }
        public function getThought()
        {
            try{
                $array = $GLOBALS['pdo'] ->find('thought',"t_id = '.$this->t_id.'") ;
            }catch (PDOException $e){
                echo '查询失败，请稍后重试。';
            }
        }

        public function getUserThoughts()
        {

        }
    }

    class getRemark                 //根据 评论ID 得到评论详情
    {
        public $r_id;

        /**
         * @param mixed $r_id
         */
        public function setRId($r_id)
        {
            $r_id = $_GET['r_id'];
           return $this->r_id = $r_id;
        }

        public function getRemark()
        {
            try{
                $array = $GLOBALS['pdo'] ->find('remark',"r_id = '.$this->r_id.'") ;
            }catch (PDOException $e){
                echo '查询失败，请稍后重试。';
            }
        }
    }

    class getUserInfo       //根据用户名得到用户信息详情
    {
        public $account;

        /**
         * @param mixed $account
         */
        public function setAccount($account)
        {
            $account = $_SESSION['account'];
           return $this->account = $account;
        }

        public function getUserInfo()
        {
            try{
                $array = $GLOBALS['pdo'] ->find('userinfo',"account = '.$this->account.'") ;
            }catch (PDOException $e){
                echo '查询失败，请稍后重试。';
            }
        }
    }



