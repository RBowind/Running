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
    /**
     * @param mixed $pdo
     */
    public function __set($name, $value)
    {
        // TODO: Implement __set() method.
        $this->name = $value;
    }

    public function __get($name)
    {
        // TODO: Implement __get() method.
        return $this->name;
    }


    public function getLatestActivities()
    {
        try{
            if ($activity=$GLOBALS['pdo']->find('activity'))
            {
                 $a =array(
                     'array' => array()
                 );

                for ($i=0;$i<count($activity);$i++){

                    /*$a = array(
                        'array'=>array(
                            $activity[$i],
                        )
                    );*/

                array_push($a['array'],$activity[$i]);
                }
               // unset($activities[0]);
                echo json_encode($a);

            }
        }catch (PDOException $e){
            echo '查询失败，请稍后重试!';
        }
    }

}

$test = new index();
$test->getLatestActivities();
