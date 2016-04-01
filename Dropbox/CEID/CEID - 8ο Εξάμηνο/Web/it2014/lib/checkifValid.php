<?php
include_once '../db/connect.php';
if (isset($_POST['uname'])) {
	$uname = $_POST['uname'];
	$query = "SELECT * FROM users WHERE uname = '$uname';";
	$result = mysqli_query($mysql_con, $query);
	$num = mysqli_num_rows($result);

	if($num > 0){
		$ok = false;
	}
	else {
		$ok = true;
	}
}
if (isset($_POST['email'])) {
	$email = $_POST['email'];
	$query = "SELECT * FROM users WHERE email = '$email';";
	$result = mysqli_query($mysql_con, $query);
	$num = mysqli_num_rows($result);

	if($num > 0){
		$ok = false;
	}
	else {
		$ok = true;
	}
}
if (isset($_POST['cat'])) {
	$cat = $_POST['cat'];
	$query = "SELECT * FROM categories WHERE name = '$cat';";
	$result = mysqli_query($mysql_con, $query);
	$num = mysqli_num_rows($result);

	if($num > 0){
		$ok = false;
	}
	else {
		$ok = true;
	}
}
echo json_encode(array(
    'valid' => $ok,
));
?>
                            
                            
                            