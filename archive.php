<?php
session_start();
ob_start();
$pageperms = 'secure';
$title = 'Αναφορές';
include 'header.php';
require_once 'db/connect.php';
?>

<div class="container">
	<div class="page-header text-right">
      <h2><? echo $title;?></h2>
    </div>

	<?php
	
	//----- Check the GET values -----//
	$u = isset($_GET['u']) ? $_GET['u'] : null;
	$cat = isset($_GET['c']) ? $_GET['c'] : null;
	$status = isset($_GET['s']) ? $_GET['s'] : null;

	//----- Choose and save the correct URL for better use of pagination -----//
	if (isset($_GET['p'])) {
		$page = $_GET['p'];
		$url = $_SESSION['url'];
	}
	else {
		$page = 0;
		$url = $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'] . '&';
		$_SESSION['url'] = $url;
	}

	$index = ($page)*20;
	
	//----- Find the correct WHERE clause for the archive filtering -----//
	if ($u != NULL) {
		$w = "author = '$u'"; // $w is for the WHERE clause
		if ($status != NULL) {
			$w = "status = '$status' AND author = '$u'";
		}
	}
	elseif ($status != null) {
		$w = "status = '$status'";
	}
	elseif ($cat != null) {
		$w = "category = '$cat'";
	}
	else {
		$w = 1;
	}
	
	//----- Select the 20 reports for each page -----//
	$query = "SELECT *
		FROM reports
		WHERE $w
		ORDER BY id DESC
		LIMIT $index,20";

	//----- Search database for the total number of reports -----//
	$my_query = "SELECT *
			FROM reports
			WHERE $w
			ORDER BY id DESC";

	$result = mysqli_query($mysql_con, $query);
	$res = mysqli_query($mysql_con, $my_query);
	$rep_count = mysqli_num_rows($res); #5

	$left_rep = $rep_count - (($page) * 20);	// The remaining reports for next pages
	?>

	<table class="table table-hover">
		<thead>
			<tr>
				<th></th>
				<th>Τίτλος</th>
				<th>Κατηγορία</th>
				<th>Υποβλήθηκε από</th>
				<th>Επιλύθηκε από</th>
				<th>Απάντηση</th>
				<th></th>
			</tr>
		</thead>
		<?php 
		while($row = mysqli_fetch_array($result)) {
			$images = explode(',', $row['image']);
			echo "<tr>";
				if ($images[0] != 'no-photo.png') {
					echo "<td><a href='report.php?r=" . $row['id'] . "'>"?><img height="42" width="42" src="uploads/report_<?php echo $row['id'] . '/' . md5($images[0]);?>" alt="image.jpg" class="img-square img-responsive"><?php echo "</a></td>";
				} else {
					echo "<td><a href='report.php?r=" . $row['id'] . "'>"?><img height="42" width="42" src="uploads/<?php echo md5($images[0]);?>" alt="image.jpg" class="img-square img-responsive"><?php echo "</a></td>";
				}
				echo "<td><strong>" . $row['title'] . "</strong></td>";
				echo "<td><a href='archive.php?c=" . $row['category'] . "'>" . $row['category'] . "</a></td>";
				echo "<td>" . $row['author'] . "</td>";
				echo "<td>" . $row['solvedby'] . "</td>";
				echo "<td>" . $row['response'] . "</td>";
				if ($row['status']=='Κλειστό') {
					echo "<td><i class='fa fa-check-circle-o text-success'></i></td>";
				}
				else {
					echo "<td><i class='fa fa-circle-o'></i></i></td>";
				}
				echo "<td><a class='text-danger' onClick='return confirm(\"Σε περιπτωση που πατήσετε OK, αυτή η αναφορά θα διαγραφεί για ΠΑΝΤΑ\");' href='db/delete/delete_report.php?r=" . $row['id'] . "'><i class='fa fa-trash-o'></i></a>" . "</td>";
			echo "</tr>";
		}?>
	</table>
	
	<!-- Pagination -->
	<div class="pagination-center">
		<ul class="pager">
			<?php if (mysqli_num_rows($result) != $rep_count) {
				if ($left_rep <= 20) {
					$last = $page - 1;
					echo "<li><a href='" . $url . "p=$last'>&#8592; Νέα</a></li>";
					echo "<li class='disabled'><a href='#'>Παλιά &#8594;</a></li>";
				}
				else if ($page == 0) {
					$last = $page + 1;
					echo "<li class='disabled'><a href='#'>&#8592; Νέα</a></li>";
					echo "<li><a href='" . $url . "p=$last'>Παλιά &#8594;</a></li>";
				}
				else if ($page > 0) {
					$last = $page - 1;
					$page++;
					echo "<li><a href='" . $url . "p=$last'>&#8592; Νέα</a></li> ";
					echo "<li><a href='" . $url . "p=$page'>Παλιά &#8594;</a></li>";
				}
			}?>
		</ul>
	</div>
	
	<!-- Categories -->
	<div class="alert alert-info">
		<p class="text-center"><em>Εμφανίζονται οι 20 τελευταίες αναφορές</em></p>
	</div>
	<?php if ($_SESSION['session_type'] == 'admin') {?>
	<div class="row" id="cat">
		<div class="col-md-4">
			<table class="table" id="myTable">
				<thead>
					<tr>
						<th>Κατηγορίες</th>
						<th><input type="button" id="toggle" class="btn btn-default" value="επεξεργασία"></input></th>
					</tr>
				</thead>
				<?php 
				$query2 = "SELECT * FROM categories";
				$res2 = mysqli_query($mysql_con, $query2);

				$i = 0;
				while($row2 = mysqli_fetch_array($res2)) {
					echo "<tr>";
					echo "<td id='edit'><a href='archive.php?c=" . $row2['name'] . "' class='editable' data-url='db/update/update_cat.php' data-type='text' data-pk='" . $row2['name'] . "'>" . $row2['name'] . "</a></td>";
					echo "<td><a href='db/delete/delete_cat.php?c=" . $row2['name'] . "' onClick='return confirm(\"Θα σβηστεί αυτή η κατηγορία για ΠΑΝΤΑ\")' class='text-danger'><i class='fa fa-trash-o'></i></a></td>";
					echo "</tr>";
				}?>
			</table>
			<form class="form-inline" id="cat" method="post" action="db/add/add_cat.php">
				<div class="form-group">
					<input type="text" name="cat" class="form-control" placeholder="Νέα κατηγορία"></input>
				</div>
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span></button>
			</form>
		</div>
		<div class="col-md-4 col-md-offset-1">
			<div class="well alert-info" style="margin-top:20px">
				<i class="fa fa-info-circle fa-3x pull-left"></i><i>Για να επικυρώσετε τις αλλαγές στις κατηγορίες κάντε <strong>refresh</strong> τη σελίδα</i>
			</div>
			<div class="well alert-danger">
				<i class="fa fa-exclamation-circle fa-3x pull-left"></i><i>Για κάθε κατηγορία που διαγράφετε, διαγράφονται και <strong>όλες</strong> οι αναφορές της</i>
			</div>
		</div>
	</div>
	<?php }?>
</div>
<?php
include_once 'footer.html';
?>
<!-- Javascripts for editing the categories -->
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script>
	$.fn.editable.defaults.mode = 'inline';
	$('#toggle').click(function() {
       	$('#myTable .editable').editable('toggleDisabled');
       	$('#toggle').toggleClass('active');
   	});
	$('#myTable .editable').editable('disable');
</script>
<script src="js/bootstrapValidator.min.js"></script>
<script>
$(document).ready(function(){
   	$("#cat form").bootstrapValidator({
        message: 'Αυτό δεν είναι σωστό',
		feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
      	fields: {
            cat: {
                validators: {
                    notEmpty: {
                        message: 'Πρέπει να βάλετε κάτι'
                    },
                    remote: {
                		url: 'lib/checkifValid.php',
                		message: 'Αυτή η κατηγορία υπάρχει'
                	}
                }
            }
        }
	});
});
</script>