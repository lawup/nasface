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
echo "<br><b>Step 4 →</b><br>";

//$picurl



if($Ap!=NULL)
{
echo "<p align=\"center\"><img src=\"".$new_picurl."\" width=\"256\"></p>";
$Ap_md5 = md5($Ap);
echo "<p align=\"center\"><a target=\"main_4\" href=\"4_onchain.php?Ap_md5=".$Ap_md5."\">下一步 在区块链上查询/记录 →</a></p>";
}
else
{
	echo "未识别出人脸特征点，请换照片！";
	echo "<a href=\"javascript:;\" onClick=\"javascript :history.back(-1);\">返回！</a>";
}




?>


<br>



</body>
</html>
