<?php
/**
 * Created by PhpStorm.
 * User: RBowind
 * Date: 2016/9/12
 * Time: 10:24
 *
 * 照片文件名 name = photo . 上传大小不超过200KB
 */


function extend($file_name)
{
    $extend = pathinfo($file_name);
    $extend = strtolower($extend["extension"]);
    return $extend;
}
    $path = "photo/";

$array = array("jpg","png","gif","jpeg");

    if(isset($_POST) and $_SERVER['REQUEST_METHOD'] =="POST" )
    {
        $name = $_FILES['photo']['name'];
        $size = $_FILES['photo']['size'];

        if (empty($name))
        {
            echo "Please choose your photo";
            exit();
        }

        $ext = extend($name);
        if(!in_array($ext,$array))
        {
            echo "Wrong picture format";
            exit();
        }

        if($size>(200*1024))
        {
            echo 'The size of picture can not exceed 200KB  ';
            exit();
        }
        $imageName = time().rand(100,999).".".$ext;
        $tmp = $_FILES['photo']['tmp_name'];
        if(move_uploaded_file($tmp,$path.$imageName))
        {
            echo '<img src="'.$path.$imageName.'" class ="preview">';
        }else{
            echo "Upload failed!";
        }

        exit();

    }