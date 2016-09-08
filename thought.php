<?php
/**
 * Created by PhpStorm.
 * User: 赵天歌
 * Date: 2016/8/19
 * Time: 0:33
 * 功能：实现发布感想的功能。此功能也必须先登录来保持session。
 * 通过get方法传递 act的值postActivity，内容用JSON格式，传递的活动信息用post方法：
 * 't_id' => self::setTId($this->t_id),
    '@account' => $_POST['@account'],
    'postTime'=> $_POST['postTime'],
    'content' =>$_POST['content'],
    'routesMaps' =>$_POST['routesMaps']
 * 成功返回感想信息，200
 */
    require_once 'header.php';
    if(!isset($_SESSION['account']))
    {
    	exit("请注册或登录");
    }

    class thought
    {
        public $t_id ;

        /**
         * @param mixed $t_id
         */
        public function setTId($t_id)
        {
            date_default_timezone_set('Asia/Shanghai');
            $time = date("Y-m-d H:i:s");
            $t_id = $_SESSION['account'].$time;
            return $this->t_id = $t_id;
        }

        public function postThought()
        {
            $account = $_SESSION['account'];
            $pdo = new PdoMySQL();
            $data = array(
                't_id' => self::setTId($this->t_id),
                '@account' => $_POST['@account'],
                'postTime'=> $_POST['postTime'],
                'account' =>$account,
                'content' =>$_POST['content'],
                'routesMap' =>$_POST['routesMap']
            );

            $pdo -> add($data,'thought');
            var_dump($data);


        }
    }

    $act = $_GET['act'];

    if ($act === 'postThought'){
        try
        {
            $thought = new thought();
            $thought ->postThought();
        }catch (PDOException $e)
        {
            echo "服务器正忙，请稍后重试"."<br>";
            echo $sql . "<br>" . $e->getMessage();
        }

    }




    


   

