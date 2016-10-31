<?php
/**
 * Created by 赵天歌 on 2016/10/30.
 * Time: 16:47
 * 需要get方法传入act = join 或者 cancel 再加上 a_id
 * eg:localhost/running/JoinandCancel.php?act=join&a_id=赵天歌1477817867
 *
 * localhost/running/JoinandCancel.php?act=cancel&a_id=赵天歌1477817867
 */
require_once 'header.php';
@$act = $_GET['act'];
$pdo = new PdoMySQL();

if($act === 'join')
{
    $data = array(
        'account' => $_SESSION['account'],
        'a_id' => $_GET['a_id'],
        'time' => date("Y-m-d H:i:s")

    );
    if ($pdo->add($data, 'joinactivity')) {
        echo true;
    } else {
        echo 'you have already joined';
    }
}
elseif ($act === 'cancel')
{

       if( $pdo -> delete('joinactivity',"a_id='".$_GET['a_id']."' and account='".$_SESSION['account']."'") )
       {
           echo true;
       }else{
           echo 0;
           echo 'sorry,cancel failed';
       }


}