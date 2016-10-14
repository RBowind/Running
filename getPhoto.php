<?php
/**
 * Created by 赵天歌 on 2016/10/13.
 * Time: 21:24
 */
require_once 'header.php';

     function getPhoto($account)
    {
        $pdox = new PdoMySQL();
        $sql = "SELECT photo FROM userinfo WHERE account ='$account'";
        $photo = $pdox -> getrow($sql);
        $photoUrl =$photo['photo'];
        echo $photoUrl;


    }


//$getPhoto = new getPhoto();
