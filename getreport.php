<?php
	include('config.php');
	if($_GET['file'])
	{
		extract($_GET);
		$row 	= mysqli_query($con,"select * from report where file_name='$file'");
		echo "<ol>";
		while($a = mysqli_fetch_assoc($row))
		{
			?>
				<li style="margin:10px;" id="<?= $a['id'];?>" target="_blank"><a href="<?= $csv_url.$a['report_location']; ?>" target="_file"><?= $a['report_location']; ?></a></li>
			<?php
		}
		echo "</ol>";
	}
?>
