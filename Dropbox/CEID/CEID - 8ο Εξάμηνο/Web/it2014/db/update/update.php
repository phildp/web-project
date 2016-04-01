<?php
	include '../connect.php';
	
	$col = $_POST['name'];
	$value = $_POST['value'];
	$uname = $_POST['pk'];
	
	$my_query = "UPDATE users SET $col = '$value' WHERE uname = '$uname'";

	$res = mysqli_query($mysql_con, $my_query) or die(mysql_error());

	mysqli_close($mysql_con);
?>