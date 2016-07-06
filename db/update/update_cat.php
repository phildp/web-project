<?php
if ($_POST) {
	include '../connect.php';
	
	$name = $_POST['value'];
	$old = $_POST['pk'];
	
	$my_query = "UPDATE categories SET name = '$name' WHERE name = '$old'";

	$res = mysqli_query($mysql_con, $my_query) or die(mysql_error());

	mysqli_close($mysql_con);
}
?>