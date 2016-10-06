<?php
/**
 * Created by PhpStorm.
 * User: RBowind
 * Date: 2016/9/9
 * Time: 21:32
 */
require_once 'header.php';

$GLOBALS['pdo'] = new PdoMySQL();



class index
{

    public $time;






    /*//设置每页数量
     $pageSize = $this->pageSize = 3;

    //得到数据总行数
    $sql = 'SELECT COUNT(*) FROM activity';

    $row = $GLOBALS['pdo']->getAll($sql);

    $rows = $this->rows = $row[0]['COUNT(*)'];

    //得到页数n
    $this->pages = intval($rows/$pageSize) ;

    //判断当前页数
    $nowPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

    //偏移量
    $this->offset = ($nowPage-1)*$pageSize;*/







    public function getLatestActivities()
    {

        //得到一个月前时间
        date_default_timezone_set('Asia/Shanghai');

        $this->time= date("Y-m-d",mktime(0,0,0,date("m")-1,date("d"),date("Y")));

        //设置每页数量
        $pageSize = $this->pageSize = 10;

        //得到数据总行数
        $sql = 'SELECT COUNT(*) FROM activity';

        $row = $GLOBALS['pdo']->getAll($sql);

        $rows = $this->rows = $row[0]['COUNT(*)'];

        //得到页数n
        $this->pages = intval($rows/$pageSize) ;

        //判断当前页数
        $nowPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

        //偏移量
        $this->offset = ($nowPage-1)*$pageSize;

        try{
            if ($activity=$GLOBALS['pdo']->find('activity',"postTime >'$this->time'",'*',null,null,'time desc',"$this->offset,$this->pageSize"))
            {
                 $a =array(
                     'array' => array()
                 );

                for ($i=0;$i<count($activity);$i++)
                {
                    array_push($a['array'],$activity[$i]);
                }

                echo json_encode($a);

            }
        }catch (PDOException $e){
            echo '查询失败，请稍后重试!';
        }
    }

}

    $test = new index();

    $test->getLatestActivities();






