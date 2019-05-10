<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<?php
	include('config.php');
	$sql = "select distinct file_name from bjp4 order by id desc";
	$row = mysqli_query($con,"$sql");
?>
<form method="post" action="getcsv.php">
	<select name="file_name" required>
		<?php
			while($a = mysqli_fetch_assoc($row))
			{
				?>
					<option><?= $a['file_name'];?></option>
				<?php
			}
		?>
	</select>
	<br>

	<textarea placeholder="Enter Your message here" required rows="6" name="msg"></textarea>
	<br>
	<input type="submit">
</form>
</body>
</html>