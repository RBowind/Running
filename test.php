<?php
/**
 * Created by 赵天歌 on 2016/10/5.
 * Time: 15:50
 */


date_default_timezone_set('Asia/Shanghai');

$time= date("Y-m-d",mktime(0,0,0,date("m"),date("d")-3,date("Y")));

$nowtime = date("Y-m-d H:i:s");

echo $nowtime>$time;


