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
echo "<br><b>Step 3 →</b><br>";

//$picurl


$picurl_1 = $picurl."/3croped/face.jpg";
$picurl_2 = $picurl."/3croped/face.png";

if(file_exists($picurl_1))
{
//echo "<p align=\"center\"><img src=\"".$picurl."/1detect/face.jpg\" width=\"300\"></p>";
//echo "<p align=\"center\"><img src=\"".$picurl."/2align/face.jpg\" width=\"300\"></p>";
echo "<p align=\"center\"><img src=\"".$picurl_1."\" width=\"256\"></p>";
echo "<p align=\"center\"><a target=\"main_3\" href=\"3_facepoint.php?picurl=".$picurl_1."\">下一步 人脸特征点提取 →</a></p>";
echo "<p align=\"center\"><small>点击后请耐心等待，计算过程大约10秒，期间请不要再次点击，直到右边出现结果</small></p>";	
}
elseif(file_exists($picurl_2))
{
echo "<p align=\"center\"><img src=\"".$picurl_2."\" width=\"256\"></p>";
echo "<p align=\"center\"><a target=\"main_3\" href=\"3_facepoint.php?picurl=".$picurl_2."\">下一步 人脸特征点提取 →</a></p>";
echo "<p align=\"center\"><small>点击后请耐心等待，计算过程大约10秒，期间请不要再次点击，直到右边出现结果</small></p>";		
}
else
{
	echo "没有提取出有效人脸！请回到第一步重新上传包含人脸的图片！";
}



?>


<br>



</body>
</html>
