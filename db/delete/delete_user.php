<?php
session_start();
ob_start();
include '../connect.php';

$u = $_GET['u'];

$my_query = "DELETE FROM users
			WHERE uname = '$u'";

$result = mysqli_query($mysql_con, $my_query) or die(mysql_error());

if ($_SESSION['session_username'] == $u) {
	header('location: ../../lib/logoff.php');
}
else {
	header("Location: {$_SERVER['HTTP_REFERER']}");
}
?>

                            
                            