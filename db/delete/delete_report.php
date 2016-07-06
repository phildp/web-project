<?php
session_start();
ob_start();
include '../connect.php';

$id = $_GET['r'];

$my_query = "DELETE FROM reports
			WHERE id = '$id'";

$result = mysqli_query($mysql_con, $my_query) or die(mysql_error());

$dirPath = "../../uploads/report_" . $id;

foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dirPath, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $path) {
    $path->isDir() ? rmdir($path->getPathname()) : unlink($path->getPathname());
}
rmdir($dirPath);

header("Location: /");
?>

                            