<?php


function extend($file_name)
{
$extend = pathinfo($file_name);
$extend = strtolower($extend["extension"]);
return $extend;
}

$path = "./photo/";



$array = array("jpg","png","gif","jpeg");

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] =="POST" ) {
    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];

    if (empty($name)) {
        echo "Please choose your photo";
        exit();
    }

    $ext = extend($name);
    if (!in_array($ext, $array)) {
        echo "Wrong picture format";
        exit();
    }

    if ($size > (5000 * 1024)) {
        echo 'The size of picture can not exceed 5M ';
        exit();
    }
   $imageName = time() . rand(100, 999) . "." . $ext;
   /* $data = file_get_contents('php://input');
    $str = base64_decode($data);
    $fp = fopen($path . $imageName, 'w');
    fwrite($fp, $str);
    fclose($fp);*/
    $tmp = $_FILES['file']['tmp_name'];
    if(move_uploaded_file($tmp,$path.$imageName))
    {
    echo '<img src="'.$path.$imageName.'" class ="preview">';
    echo 'success!';
    }else{
    echo "Upload failed!";
        echo $_FILES['file']['tmp_name'];
        echo $_FILES['file']['size'];
    }

    exit();
}
