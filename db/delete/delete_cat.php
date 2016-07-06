<?php
session_start();
//ob_start();
if ($_GET['c']) {
	include '../connect.php';

	$cat = $_GET['c'];


	$my_query1 = "SELECT * FROM reports WHERE category = '$cat'";
	echo $cat;

	$result1 = mysqli_query($mysql_con, $my_query1);

	while ($row1 = mysqli_fetch_array($result1)) {
		$dirPath = "../../uploads/report_" . $row1['id'];
		echo $dirPath;
		foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dirPath, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $path) {
		    $path->isDir() ? rmdir($path->getPathname()) : unlink($path->getPathname());
		}
		rmdir($dirPath);
	}
	$my_query = "DELETE FROM categories WHERE name = '$cat'";

	$result = mysqli_query($mysql_con, $my_query) or die(mysql_error());

	header('Location: ' . $_SERVER['HTTP_REFERER'] . "#cat");
}
?>