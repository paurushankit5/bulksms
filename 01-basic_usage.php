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
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);

require_once __DIR__.'/SimpleXLSX.php';
require_once __DIR__.'/config.php';
if ($handle = opendir('./upload')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {

            $files[]=$entry;
        }
    }

    closedir($handle);
}

$files_in = "'".implode("','",$files)."'";
$sql = "select distinct file_name from bjp4 where file_name in ($files_in)";
$row = mysqli_query($con,$sql);
//echo $sql;
//echo "<pre>";
//print_r($files);
$files_processed = array();
while($a = mysqli_fetch_assoc($row))
{
	$files_processed[] = $a['file_name'];
}
//print_r($files_processed);
$diff = array_diff($files,$files_processed);
print_r($diff);
//exit;
if(count($diff))
{
	foreach($diff as $file_name)
	{
		echo "processing $file_name";
		$file_name = "upload/".$file_name;
		if ( $xlsx = SimpleXLSX::parse($file_name) ) {
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
						//echo "<pre>";
					//print_r($row[29]);
		 			
					$sql = "insert into bjp4 (part_no, slnoinpart, fm_name_e, idcard_no, mobile, file_name) values('$row[0]', '$row[1]', '$row[10]', '$row[7]',  '$row[29]','$file_name')";
						mysqli_set_charset($con,'utf8');
						if(mysqli_query($con,$sql)){
							echo $i;
						}
						else{
							echo mysqli_error($con);
							echo $sql;
						}
					 
					//echo $sql;
					 echo "<br>";
					 echo "<br>";
					}
					$i++;
				}
			}
		} else {
			echo SimpleXLSX::parseError();
		}
	}
}
echo "done";



	?>

</body>
</html>