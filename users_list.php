<?php
session_start();
ob_start();
$pageperms = 'secure';
$title = 'Χρήστες';
include 'header.php';
require_once 'db/connect.php';
?>

<div class="container">
	<div class="page-header text-right">
      <h2><? echo $title;?></h2>
    </div>

	<?php

	$query = "SELECT *
			FROM users";

	$result = mysqli_query($mysql_con, $query);

	if(mysqli_num_rows($result) == 0) // User not found.
	{
		echo "<h3>Δεν βρέθηκε κανένας χρήστης</h3>";
		include_once 'footer.html';
		exit();
	}
	//$row = mysqli_fetch_array($result);

	?>

	<table class="table">
		<thead>
			<tr>
				<th>Όνομα</th>
				<th>Επώνυμο</th>
				<th>Όνομα χρήστη</th>
				<th>Email</th>
				<th>Τηλέφωνο</th>
				<th>Άδεια</th>
				<th></th>
			</tr>
		</thead>
		<?php 
		while($row = mysqli_fetch_array($result)) {
		echo "<tr>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>" . $row['surname'] . "</td>";
			echo "<td>" . $row['uname'] . "</td>";
			echo "<td>" . $row['email'] . "</td>";
			echo "<td>" . $row['phone'] . "</td>";
			echo "<td>" . $row['type'] . "</td>";
			echo "<td><a href='view.php?u=" . $row['uname'] . "'><span class='glyphicon glyphicon-eye-open' /></a>" . "</td>";
			echo "<td><a class='text-danger' onClick='return confirm(\"Σε περιπτωση που πατήσετε OK ο" . " ´" . $row['uname'] . "´ θα διαγραφεί για ΠΑΝΤΑ\");' href='db/delete/delete_user.php?u=" . $row['uname'] . "'><i class='fa fa-trash-o'></i></a>" . "</td>";
		echo "</tr>";
		}?>
	</table>
</div>
<?php
include_once 'footer.html';
?>