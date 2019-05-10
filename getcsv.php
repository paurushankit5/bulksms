
<?php
	include('config.php');
	if(isset($_POST['file_name']))
	{
		extract($_POST);
		echo "<prE>";
		$sql = "select count(*) as total_count from bjp4 where file_name ='$file_name'";
		$total_count = mysqli_fetch_assoc(mysqli_query($con,"$sql"))['total_count'];
		for($i=0;$i<=$total_count;$i=$i+$result_limit)
		{
			$new_file = rand(1111,999999).strtotime(date('Y-m-d H:i:s')).".csv";

			$sql2 = "select mobile, CONCAT('Hello ', fm_name_e , '. ' , '$msg', ' Please click on the link below to find your details. ','$base_url',id) as msg from bjp4 where file_name ='$file_name' limit $i,$result_limit 
				INTO OUTFILE '$base_dir$new_file'
				FIELDS TERMINATED BY ','
				ENCLOSED BY '\"'
				LINES TERMINATED BY '\\n'
			";

			//echo $sql2."<br>";
			$b = mysqli_query($con,$sql2);
			$files[] = $new_file;
			
			//exit;
		}
		if(count($files))
		{
			mysqli_query($con,"Delete from report where file_name='$file_name'");
			foreach ($files as $file) {
				if(mysqli_query($con,"insert into report (file_name,report_location) values ( '$file_name','$file')")){

				}
				else{
					echo mysqli_error($con);
				}
			}
		}
		header('location:getreport.php?file='.$file_name);
	}
	
?>
 
 