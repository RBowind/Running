<?php
/**
 * Created by 赵天歌 on 2016/11/1.
 * Time: 13:23
 */

require_once 'header.php';

$a_id = $_GET['a_id'];

$pdo = new PdoMySQL();
$users =  $pdo-> find('joinactivity',"a_id ='$a_id'",'account');
$row = count($users);

//print_r($users);

$data = array(
    'becanceled' => 1
);

for ($i=0;$i<$row;$i++)
{
   if($pdo -> update($data,'joinactivity',"account ='".$users[$i]['account']."' and a_id ='$a_id'"))
   {
       echo true;
   }
}






