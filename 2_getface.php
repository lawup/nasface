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


//echo $picurl;



$picurl = str_replace("/face.jpg","",$picurl);
$picurl = str_replace("/face.png","",$picurl);



//echo $picurl;


$program="python 2_getface.py ".$picurl; #注意使用绝对路径
exec ($program);



echo "
<frameset cols=\"270,*\" framespacing=\"0\" border=\"0\" frameborder=\"0\">
	<frame name=\"contents\" target=\"main_3\" src=\"2_getface_ed.php?picurl=".$picurl."\">
	<frame name=\"main_3\" src=\"blank.htm\">
</frameset>
";




?>


</html>


