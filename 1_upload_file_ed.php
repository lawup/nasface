<!doctype html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <title>NasFace</title>
</head>
<body>


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

echo "<br>";
echo "<br>";
echo "<br><b>Step 2 →</b><br>";

echo "<p align=\"center\"><img src=\"".$picurl."\" width=\"280\"></p>";
echo "<p align=\"center\"><a target=\"main_2\" href=\"2_getface.php?picurl=".$picurl."\">下一步 人脸提取并对齐 →</a></p>";
echo "<p align=\"center\"><small>点击后请耐心等待，计算过程大约一分钟，期间请不要再次点击，直到右边出现结果</small></p>";


?>


<br>



</body>
</html>
