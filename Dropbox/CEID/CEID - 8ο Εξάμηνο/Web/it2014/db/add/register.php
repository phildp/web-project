<?php
if($_POST)
{
	session_start();
	//ob_start();
	include '../connect.php';

	$fname = trim($_POST['fname']);
	$lname = trim($_POST['lname']);
	$email = trim($_POST['email']);
	$uname = trim($_POST['uname']);

	$password = trim($_POST['pass']);
	$phone = trim($_POST['phone']);

	//------- Cryptographing password -------//
	$hash = hash('sha256', $password);
 
	function createSalt()
	{
   		$text = md5(uniqid(rand(), true));
    		return substr($text, 0, 3);
	}
 	
	$salt = createSalt();
	$password_hash = hash('sha256', $salt . $hash);

	//------- Inserting user data into database -------//
	$my_query = "INSERT INTO users (name, surname, email, uname, pass, phone, salt)
			VALUES ( '$fname', '$lname', '$email', '$uname', '$password_hash', '$phone', '$salt');";

	mysqli_query($mysql_con, $my_query);
	
	//------- Set the SESSION values -------//
	$_SESSION['session_email'] = $email;
	$_SESSION['session_password'] = $password;
	$_SESSION['session_username'] = $uname;

	mysqli_close($mysql_con);

	//------- After registering automatically login  -------//
	header('location: ../../login.php');
}
?>