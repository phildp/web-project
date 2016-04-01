<?php
if($_POST['cat']) {
	include_once '../connect.php';

	$cat = trim($_POST['cat']);

	$my_query = "INSERT INTO categories (name) VALUES ('$cat');";

	mysqli_query($mysql_con, $my_query) or die(mysqli_report());
	mysqli_close($mysql_con);
	
	//------- Go back to archive page where categories are -------//
	header('Location: ' . $_SERVER['HTTP_REFERER'] . "#cat");
}
?>