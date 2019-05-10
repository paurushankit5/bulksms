<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once __DIR__.'/SimpleXLSX.php';
require_once __DIR__.'/config.php';
echo "<prE>";
$sql = mysqli_query($con,"select id,fm_name_en,mobile from bjp3 where id>=7");
while($row = mysqli_fetch_assoc($sql)){
	$msg = "Hello ".$row['fm_name_en'].", To view your polling details, click on this link ".$base_url.$row['id'];
	echo $msg."<br>";
	echo smsgatewaycenter_com_Send($row['mobile'],$msg);
}
function smsgatewaycenter_com_Send($mobile, $sendmessage)
{
	//http://apps.smslane.com/vendorsms/pushsms.aspx?user=Tarun%20Manna&password=tarun_123&msisdn=919002187227&sid=EXAGRO&msg=sms testing &fl=0&gwid=2
	$smsgatewaycenter_com_user = "t1gyanendramix"; //Your SMS Gateway Center Account Username
	$smsgatewaycenter_com_password = "47688844";  //Your SMS Gateway Center Account Password
	$smsgatewaycenter_com_url = "http://nimbusit.co.in/api/swsendSingle.asp?"; //SMS Gateway Center API URL
	$smsgatewaycenter_com_mask = "GYANII"; //Your Approved Sender Name / Mask
	$parameters = 'username='.$smsgatewaycenter_com_user;
	$parameters.= '&password='.$smsgatewaycenter_com_password;
	$parameters.= '&sendto='.urlencode($mobile);
	$parameters.= '&sender='.urlencode($smsgatewaycenter_com_mask);
	$parameters.= '&message='.urlencode($sendmessage);
	//$parameters.= '&fl=0&gwid=2';
	$api_url =  $smsgatewaycenter_com_url.$parameters;
	$ch = curl_init($api_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$curl_scraped_page = curl_exec($ch);
	curl_close($ch);			
	return($curl_scraped_page);
}
?>
</body>
</html>