<?php
	session_start();
	ob_start();
  	$pageperms = 'public';
  	$title = 'Λάθος Είσοδος';
	include_once 'header.php';
	
	//------- Check weather the user is logging by himself or after registering -------//
	if(!isset($_SESSION['session_email']) || (!isset($_SESSION['session_password']))) {
		$email = $_POST['email'];
		$password = $_POST['pass'];
	} else {
		$email = $_SESSION['session_email'];
		$password = $_SESSION['session_password'];
	}
	
	include_once 'db/connect.php';
	
	$email = mysqli_real_escape_string($mysql_con, $email);

	$query = "SELECT *
		FROM users
		WHERE email = '$email';";
	 
	$result = mysqli_query($mysql_con, $query);
	 
	if(mysqli_num_rows($result) == 0) // User not found. So, redirect to login_form again.
	{
		//------- Wrong email -------//
		echo '<div class="container">';
	    	echo '<h2>Λάθος email</h2><br/>';
		echo '<a href="javascript:history.back();">Πίσω</a>';
		echo '</div>';
		include_once 'footer.html';
		exit();
	}
	 
	$userData = mysqli_fetch_array($result, MYSQL_ASSOC);
	
	//------- Cryptographing password -------//
	$hash = hash('sha256', $userData['salt'] . hash('sha256', $password) );

	if($hash != $userData['pass']) // Incorrect password. So, redirect to login_form again.
	{
		//------- Wrong password -------//
		echo '<div class="container">';
		echo '<h2>Λάθος κωδικός</h2><br/>';
		echo '<a href="javascript:history.back();">Πίσω</a>';
		echo '</div>';
		include_once 'footer.html';
		exit();
	} else{ //------- Redirect to home page after successful login --------//
		
		session_regenerate_id();
		$_SESSION['session_user_id'] = $userData['id'];
		$_SESSION['session_username'] = $userData['uname'];	
		$_SESSION['session_type'] = $userData['type']; // Type of logged in user	
		$_SESSION['session_name'] = $userData['name'];
		$_SESSION['session_surname'] = $userData['surname'];
		session_write_close();

		header('Location: /');
		die();
	}
?>

                            
                            
                            
                            
                            
                            