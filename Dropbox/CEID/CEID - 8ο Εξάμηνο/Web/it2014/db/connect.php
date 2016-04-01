<?php
	$db_server["host"] = "localhost"; //database server
	$db_server["username"] = "root"; // DB username
	$db_server["password"] = ""; // DB password
	$db_server["database"] = "it2014_5022_5055";// database name
	
	$mysql_con = mysqli_connect($db_server["host"], $db_server["username"], $db_server["password"], $db_server["database"]);
	if (!$mysql_con)
	{
		die('Could not connect: ' . mysql_error());
	}
	$mysql_con->query ('SET CHARACTER SET utf8');
	$mysql_con->query ('SET COLLATION_CONNECTION=utf8_general_ci');
?>