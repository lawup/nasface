<!doctype html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <title>NasFace</title>
</head>



<?php

header("Content-type: text/html; charset=utf-8"); 

//session_start(); 
//提取页面和浏览器提交的变量
@extract($_SERVER, EXTR_SKIP); 
@extract($_SESSION, EXTR_SKIP); 
@extract($_POST, EXTR_SKIP); 
@extract($_FILES, EXTR_SKIP); 
@extract($_GET, EXTR_SKIP); 
@extract($_ENV, EXTR_SKIP); 
//提取完成   
error_reporting(0);


// 以下处理【图片】上传文件并得到URL

function fileupload($file)
{
$name = $file['name'];
$type = strtolower(substr($name,strrpos($name,'.')+1)); //得到文件类型，并且都转化成小写
$allow_type = array('jpg','png'); //定义允许上传的类型
//判断文件类型是否被允许上传
if(!in_array($type, $allow_type)){
  //如果不被允许，则直接停止程序运行
  echo "错误_图片只能上传jpg、png格式文件！<a href=\"javascript:;\" onClick=\"javascript :history.back(-1);\">不成功，请返回！</a>";
  exit();
}

//echo $file["size"];
if(2000000 < $file["size"])  
//检查文件大小  
{  
  echo "错误_单张图片不要超过2M！<a href=\"javascript:;\" onClick=\"javascript :history.back(-1);\">不成功，请返回！</a>";
  exit(); 
}  

//判断是否是通过HTTP POST上传的
if(!is_uploaded_file($file['tmp_name'])){
  //如果不是通过HTTP POST上传的
  echo "错误_图片存在异常！<a href=\"javascript:;\" onClick=\"javascript :history.back(-1);\">不成功，请返回！</a>";
  exit();  
}

// $upload_path = "D:/phpStudy/WWW/2017bqp/uploadpic/"; //上传文件的存放路径

$thetime = time();
$upload_path = "faces/uploadpic_".$thetime.""; //上传文件的存放路径 相对地址
//开始移动文件到相应的文件夹
mkdir($upload_path);
$file['name_time'] = $upload_path."/face.".$type;

if(move_uploaded_file($file['tmp_name'],$file['name_time'])){
  //echo "Successfully!";
  //echo "uploadpic/".$file['name_time'];
  
  //RETURN "uploadpic/".$file['name_time'];
  RETURN $file['name_time'];
  
}else{
  echo "错误_图片存在异常情况！<a href=\"javascript:;\" onClick=\"javascript :history.back(-1);\">不成功，请返回！</a>";
  exit(); 
}

}


$picurl = fileupload($picfile);


if($picurl!=NULL)
{







echo "
<frameset cols=\"300,*\" framespacing=\"0\" border=\"0\" frameborder=\"0\">
	<frame name=\"contents\" target=\"main_2\" src=\"1_upload_file_ed.php?picurl=".$picurl."\">
	<frame name=\"main_2\" src=\"blank.htm\">
</frameset>
";


//echo "<p align=\"center\"><img src=\"".$picurl."\" width=\"300\"></p>";
//echo "<p align=\"center\"><a href=\"2_getface.php?picurl=".$picurl."\">下一步 人脸提取并对齐</a></p>";

}

?>


<br>




</html>


