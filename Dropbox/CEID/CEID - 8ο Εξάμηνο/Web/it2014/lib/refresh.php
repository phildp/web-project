<?php
	include_once '../db/connect.php';

	$query1 = "SELECT * FROM reports";
	$result1 = mysqli_query($mysql_con, $query1);

	$query2 = "SELECT * FROM reports WHERE status = 'Ανοικτό'";
	$result2 = mysqli_query($mysql_con, $query2);

	$query3 = "SELECT * FROM reports WHERE status = 'Κλειστό'";
	$result3 = mysqli_query($mysql_con, $query3);
	
	$all_reps = mysqli_num_rows($result1);
	$open_reps = mysqli_num_rows($result2);
	$closed_reps = mysqli_num_rows($result3);
	$diff = 0;

	//------ Calculate the average reports' waiting time ------//
	while ($row = mysqli_fetch_array($result3)){
		$sec1 = strtotime($row['solvedat']);
		$sec2 = strtotime($row['created']);
		$diff += ($sec1 - $sec2);
	}
	if ($closed_reps > 0) {
		$med = $diff / $closed_reps;
		$days = floor($med / 86400)!=0 ? (floor($med / 86400) . " Μέρα(ες)") : null;
		$hours = floor(($med - $days*86400) / 3600)!=0 ? (floor(($med - $days*86400) / 3600) . " Ώρα(ες)") : null;
		$mins = floor(($med - ($days*86400 + $hours*3600)) / 60)!=0 ? (floor(($med - ($days*86400 + $hours*3600)) / 60) . " λεπτό(ά)") : null;
		$med = array($days, $hours, $mins);
		$med = implode(' ', array_filter($med));
	}
	else {
		$med = '-';
	}
	echo $all_reps . "[BRK]" . $open_reps . "[BRK]" . $closed_reps . "[BRK]" . $med;
?>