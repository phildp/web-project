<?php
session_start();
include_once '../connect.php';

$title = $description = $category = FALSE;
$err_title = $err_category = $err_image = $val_image = NULL;

if (isset($_POST['submitted'])){
	if (isset($_POST['title'])) {
		$title = trim($_POST['title']);
	}
	else {
		$err_title = 'Δώστε τίτλο';
	}
	if (isset($_POST['description'])) {
		$description = trim($_POST['description']);
	}
	else {
		$description = NULL;
	}
	if (isset($_POST['category'])) {
		$category = $_POST['category'];
	}
	else {
		$err_category = 'Δώστε κατηγορία';
	}
	if (isset($_POST['lat'])) {
		$lat = $_POST['lat'];
	}
	else {
		$err_lat = 'Δώστε lat';
	}
	if (isset($_POST['lng'])) {
		$lng = $_POST['lng'];
	}
	else {
		$err_lng = 'Δώστε lng';
	}
	$author = $_SESSION['session_username']; //Setting the author field from the session
	if (!file_exists('../../uploads/report_' . $_SESSION['session_username'])) {
	    mkdir('../../uploads/report_' . $_SESSION['session_username'], 0777, true);
	}
	//Loop through each file
	for($i=0; $i<4; $i++) {
	  	//Get the temp file path
	  	$tmpFilePath = $_FILES['image'.$i]['tmp_name'];

	  	//Make sure we have a filepath
	  	if ($tmpFilePath != ""){
	    	//Setup our new file path
	    	$newFilePath = "../../uploads/report_" . $_SESSION['session_username'] . "/" . md5($_FILES['image'.$i]['name']);

	    	//Upload the file into the temp dir
	    	if(move_uploaded_file($tmpFilePath, $newFilePath)) {
	    		$im[$i] = $_FILES['image'.$i]['name'];
	    	}
	  	}
	  	else {
	  		$im[$i] = NULL;
	  	}
	}
	$photo = implode(',', array_filter($im));
	if ($photo == NULL) {
		$photo = 'no-photo.png';
	}

	$author = $_SESSION['session_username'];

	if ($title && $category && $lat && $lng) { //Everything is ok...

		$my_query = "INSERT INTO reports 
					(title, category, description, author, image, lat, lng, created)
					VALUES 
					('$title', '$category', '$description', '$author', '$photo', '$lat', '$lng', now());";
		
		mysqli_query($mysql_con, $my_query);

		$query = "SELECT id
			FROM reports
			WHERE author = '$author'
			ORDER BY id DESC
			LIMIT 1;";
		 
		$result = mysqli_query($mysql_con, $query);
		
		$row = mysqli_fetch_array($result);

    	rename('../../uploads/report_' . $_SESSION['session_username'], '../../uploads/report_' . $row['id']);

		header('location: ../../report.php?r=' . $row['id']);
	}
}
?>