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

//exit();


$program="python 3_facepoint.py ".$picurl;
$Ap = exec ($program);

//echo $Ap;

$new_picurl = str_replace("face.","face_68points.",$picurl);



echo "
<frameset cols=\"270,*\" framespacing=\"0\" border=\"0\" frameborder=\"0\">
	<frame name=\"contents\" target=\"main_4\" src=\"3_facepoint_ed.php?new_picurl=".$new_picurl."&Ap=".$Ap."\">
	<frame name=\"main_4\" src=\"blank.htm\">
</frameset>
";




?>


</html>


