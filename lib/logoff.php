<?php
	session_start();
	ob_start();
	$onoff = 'off';
	
	//------ Reset and delete session ------//
	session_destroy();
	unset($_SESSION['session_username']);
	unset($_SESSION['session_email']);
	unset($_SESSION['session_password']);
	unset($_SESSION['session_name']);
	unset($_SESSION['session_type']);

 	header('Location: /');
 	die();
?>

                            
                            
                            
                            