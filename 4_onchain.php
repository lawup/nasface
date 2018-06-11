<!DOCTYPE html>
<html lang="zh">


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

?>


<head>
    <meta charset="UTF-8">
    <title>NasFace</title>

    <style>
        .hide{
            display: none;
        }
    </style>
</head>

<body>

<br>
<br>
<br><b>Step 5 ↓</b><br>

        <p><input id="search_value" type="hidden" value="<?php echo $Ap_md5; ?>"></p>
        <p><button id=search> 查询 【看看Ta是谁？】 </button></p>

    <div class="result_success hide">
        <div>系统记录是：<big><font color="red"><div id=search_result>?</div></font></big></div>
		<br>
        <div class="author"><small>记录人：<div id=search_result_author>?</div></a></small></div>
    </div>

    <div class="result_faile hide">
        系统尚无该人脸记录，可<button id="add"> 添 加 </button>该人脸信息
		<!--<i id="result_faile_add">asd</i>-->
    </div>

    <div class="add_banner hide">
        <input type="text" id="add_value" maxlength="64" size="28" placeholder="这张脸主人的姓名，如“张三”">
		<p align="center"><button id="push"> 提交数据到区块链上 </button></p>
    </div>


<script src=lib/jquery-3.3.1.min.js></script>
<script src=lib/nebPay.js></script>
<script src=lib/nebulas.js></script>
<script>

    "use strict";

    var dappAddress = "n1y6JdDzFgJXbbP6KjhF5ZXHrgcCqv9Vkaq";  
	//  合约：        n1y6JdDzFgJXbbP6KjhF5ZXHrgcCqv9Vkaq
	//  部署人：      n1LZe4MjtpqBsr4YeUug2zUA1gejAymf7uu
	//  Tx hash ：    52e25cc71e43156dc38dace4a8d8fc0159e9e0e5d15b44629e59bbdbf3ac6bcb
	//  查看合约交易  https://explorer.nebulas.io/#/address/n1y6JdDzFgJXbbP6KjhF5ZXHrgcCqv9Vkaq
	//  查看合约代码  https://explorer.nebulas.io/#/tx/3fb368b822c91506c0a58593e08b5bf9922a84f72c7469c5e36053312e6bc7de

    var nebulas = require("nebulas"),
        Account = nebulas.Account,
        neb = new nebulas.Neb();
    //neb.setRequest(new nebulas.HttpRequest("https://testnet.nebulas.io")); //测试网
    neb.setRequest(new nebulas.HttpRequest("https://mainnet.nebulas.io"));   //主网

    $("#search").click(function(){
        var from = Account.NewAccount().getAddressString();
        var value = "0";
        var nonce = "0"
        var gas_price = "1000000"
        var gas_limit = "2000000"
        var callFunction = "get";
        var arg = $("#search_value").val()
        var callArgs = JSON.stringify([arg]);  
        var contract = {
            "function": callFunction,
            "args": callArgs
        }

        neb.api.call(from,dappAddress,value,nonce,gas_price,gas_limit,contract).then(function (resp) {
            cbSearch(resp)
        }).catch(function (err) {
            console.log("error:" + err.message)
        })
    })

    function cbSearch(resp) {
        var result = resp.result  
        console.log("return of rpc call: " + JSON.stringify(result))

        var resultString = JSON.stringify(result);
        if(resultString.search("key") !== -1 && resultString.search("value") !== -1){
            result = JSON.parse(result)
            $(".add_banner").addClass("hide");
            $(".result_faile").addClass("hide");
            $("#search_banner").text($("#search_value").val())
            $("#search_result").text(result.value)
            $("#search_result_author").text(result.author)
            $(".result_success").removeClass("hide");
        }
        if(resultString.search('"null"') !== -1){
            $(".add_banner").addClass("hide");
            $(".result_success").addClass("hide");
            $("#result_faile_add").text($("#search_value").val())
            $(".result_faile").removeClass("hide");
        }
        if(resultString.search("error") !== -1){
            $(".add_banner").addClass("hide");
            $(".result_faile").addClass("hide");
            $("#search_banner").text($("#search_value").val())
            $("#search_result").text(result)
            $("#search_result_author").text("")
            $(".result_success").removeClass("hide");
        }

    }

    $("#add").click(function() {
        $(".result_faile").addClass("hide");
        $(".add_banner").removeClass("hide");
        $("#add_value").val("")
    })

    var NebPay = require("nebpay"); 
    var nebPay = new NebPay();
    var serialNumber
    var callbackUrl = NebPay.config.mainnetUrl;   //主网
    //var callbackUrl = NebPay.config.testnetUrl;   //测试网

    $("#push").click(function() {

        var to = dappAddress;
        var value = "0";
        var callFunction = "save"
        var arg1 = $("#search_value").val(),
            arg2 = $("#add_value").val();
        var callArgs = JSON.stringify([arg1, arg2]);

        serialNumber = nebPay.call(to, value, callFunction, callArgs, { 
            listener: cbPush, 
            callback: callbackUrl
        });

        intervalQuery = setInterval(function () {
            funcIntervalQuery();
        }, 10000);
    });

    var intervalQuery

    function funcIntervalQuery() {
        var options = {
            callback: callbackUrl
        }
        nebPay.queryPayInfo(serialNumber,options) 
            .then(function (resp) {
                console.log("tx result: " + resp) 
                var respObject = JSON.parse(resp)
                if(respObject.code === 0){
                    clearInterval(intervalQuery);
                    alert(`成功记录人脸特征哈希值【${$("#search_value").val()}】对应【${$("#add_value").val()}】! 再次点击【查询】按钮可查询记录；可以回到第一步另传一张【${$("#add_value").val()}】的人脸图片，看看系统能否准确识别~`);
                }
            })
            .catch(function (err) {
                console.log(err);
            });
    }

    function cbPush(resp) {
        console.log("response of push: " + JSON.stringify(resp))
        var respString = JSON.stringify(resp);
        if(respString.search("rejected by user") !== -1){
            clearInterval(intervalQuery)
            alert(respString)
        }else if(respString.search("txhash") !== -1){
            //alert("wait for tx result: " + resp.txhash)
        }
    }

</script>
</body>

</html>


