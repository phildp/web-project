<?php 
if ($_POST) {
	include '../db/connect.php';
	$id = $_POST['id'];
	$solver = $_POST['solver'];
	//echo $id;
	$response = $_POST['response'];
	$timestamp = date_create();
	$solve = date_format($timestamp, 'Y-m-d H:i:s');
	$my_query = "UPDATE reports SET response = '$response', status = 'Κλειστό', solvedby = '$solver' WHERE id = '$id';";
	mysqli_query($mysql_con, $my_query);
	mysqli_close($mysql_con);
	header('location: ../report.php?r=' . $id);
}
?>