<?php
/**
 * Created by 赵天歌 on 2016/10/5.
 * Time: 15:50
 *把当前用户的用户名用 get方法传过来。参数名为：account。
 *传递过来后，这里会返回类似这样的（这里我传的值是 account=赵天歌）：{"array":[{"becanceled":"1"},{"becanceled":"0"},{"becanceled":"0"}]}
 * 定时发送请求,如果活动取消了，becanceled会变成1，那样返回的值就回和上次不同，意味活动已经发生改变，这时候提示用户去 “我的参与” 看哪些活动被取消了。
 */

require_once 'header.php';

$pdo = new PdoMySQL();


$cancel = $pdo->find('joinactivity',"account='".$_GET['account']."'",'becanceled');

$array =array(
    'array' => array()
);

for($i=0;$i<count($cancel);$i++){
    array_push($array['array'],$cancel[$i]);
}

echo json_encode($array);



