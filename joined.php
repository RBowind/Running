<?php
/**
 * Created by 赵天歌 on 2016/10/30.
 * Time: 20:38
 * 本页面包含两个功能：1列出用户参与的活动
 *localhost/running/joined.php?act=myJoin&page=**
 * 以及 得到该用户是否参加了该活动:
 * localhost/running/joined.php?act=ifJoin&a_id=赵天歌1477817867
 */
require_once 'header.php';

class myJoined
{

    public $pagesize = 5 ;

    public function myJoin()
    {
        $pdo = new PdoMySQL();

        //判断当前页数
        $nowpage = isset($_GET['page'])?intval($_GET['page']) : 1;
        //偏移量
        $this->offset = ($nowpage-1)*$this->pagesize;

        $sql = "SELECT activity.a_id,activity.cancel,activity.photo,activity.postTime,joinactivity.time,p_number,distance FROM joinactivity INNER JOIN activity 
                ON joinactivity.account='".$_SESSION['account']."' and activity.a_id=joinactivity.a_id 
                ORDER BY time desc limit $this->offset,$this->pagesize ";

        $result =  $pdo -> getAll($sql);

        $a =array(
            'array' => array()
        );

        if (count($result)==0){
            echo 0;
            echo 'you have not joined any activity';
        }else{
            for ($i=0;$i<count($result);$i++)
            {
                array_push($a['array'],$result[$i]);
            }
            echo json_encode($a);
        }
    }

   /*
   不会join时候的繁杂代码~~

   public $pagesize = 5 ;   //定义每页数量

    public function myJoin()
    {

        $pdo = new PdoMySQL();
        $sql = "SELECT * FROM joinactivity WHERE account='".$_SESSION['account']."'" ;
        $row = $pdo->getAll($sql);

        //判断当前页数
        $nowpage = isset($_GET['page'])?intval($_GET['page']) : 1;
        //偏移量
        $this->offset = ($nowpage-1)*$this->pagesize;

        if($userJoin = $pdo->find('joinactivity',"account = '" . $_SESSION['account'] . "'",'*',null,null,'time desc',"$this->offset,$this->pagesize"))
        {
            $array = array(
                'array' => array()
            );

            if(count($row)==1) {
                array_push($array['array'],$userJoin);
                echo json_encode($array);
            }else{
                for ($i=0;$i<count($userJoin);$i++) {
                    array_push($array['array'], $userJoin[$i]);
                }
                echo json_encode($array);
            }
        }else{
            echo 0;
        }

    }*/

    public function ifJoin()
    {
        $pdo = new PdoMySQL();
        if($pdo->find('joinactivity',"a_id = '" . $_GET ['a_id'] . "' and account = '" . $_SESSION['account'] . "'"))
        {
            echo true;
        }else{
            echo 0;
        }
    }

}

$object = new myJoined();
$act = $_GET['act'];
switch ($act)
{
    case "ifJoin":
        $object->ifJoin();
        break;
    case "myJoin":
        $object->myJoin();
        break;
}

