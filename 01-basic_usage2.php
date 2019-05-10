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


echo "<pre>";
if ( $xlsx = SimpleXLSX::parse('Demo.xlsx') ) {
	list( $cols, ) = $xlsx->dimension();
	if(count($xlsx->rows()))
	{
		$i= 0;
		//print_r($xlsx->rows());
		foreach ($xlsx->rows() as $row)
		{
			
			if($i!=0)
			 {
				//print_r($row);
			$row[17] = date('Y/m/d',strtotime($row[17]));
			$sql = "insert into bjp3 (ac_no, part_no, slnoinpart, house_no, section_no, fm_name, rln_type, rln_fm_nm, idcard_no, sex, age, fm_name_en, rln_fm_nm_en, house_no_en, fm_name_v1, rln_fm_nm_v1, house_no_v1, dob, mobile, status) values('$row[0]', '$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','$row[6]','$row[7]', '$row[8]','$row[9]','$row[10]','$row[11]','$row[12]','$row[13]','$row[14]','$row[15]','$row[16]','$row[17]','$row[18]','$row[19]')";
				mysqli_set_charset($con,'utf8');
				if(mysqli_query($con,$sql)){

				}
				else{
					echo mysqli_error($con);
				}
			 echo $sql.";";
			
			 echo "<br>";
			 echo "<br>";
			}
			$i++;
		}
	}
} else {
	echo SimpleXLSX::parseError();
}
echo '<pre>';

$msg = "Hello Shubham Jain,  To view your polling details, click on the link http://www.bhpdata.com/xbhjxjhbjbf1234543";
//echo smsgatewaycenter_com_Send('7531855396', $msg);
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