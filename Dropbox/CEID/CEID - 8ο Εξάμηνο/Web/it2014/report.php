<?php
session_start();
ob_start();
$pageperms = 'none';
include_once 'db/connect.php';

//----- Select from the particular report to find the page title -----//
$id = $_GET['r'];

$query = "SELECT * FROM reports WHERE id = '$id'";

$result = mysqli_query($mysql_con, $query);

if(mysqli_num_rows($result) == 0) // Report not found.
{
	$title = '404 - Not Found';
	include_once 'header.php';?>
	<div class="container">
		<h2>Δεν βρέθηκε η αναφορά</h2>
	</div>
	<?php include_once 'footer.php';
	exit();
}
$row = mysqli_fetch_array($result);
$images = explode(',', $row['image']);

$title = $row['title'] . ' - ' . $row['category'];

include_once 'header.php';
?>

<div class="container menu-padding">
    <div class="row">
      	<div class="col-md-6">
      		<!-- Photo Carousel -->
	    	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-pause="hover">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<?php for ($i=0; $i < count($images); $i++) { ?>
				<li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>"></li>
			    	<?php }?>
			</ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner">
			    <div class="item active">
			    	<?php if ($images[0] != 'no-photo.png') {?>
			      		<img src="uploads/report_<?php echo $id . "/" . md5($images[0]);?>" alt="...">
			    	<?php }
			    	else {?>
			      		<img src="uploads/<?php echo md5($images[0]);?>" alt="...">
			    	<?php }?>
			    </div>
			  	<?php for ($j=1; $j < count($images); $j++) { ?>
			    <div class="item">
			      	<img src="uploads/report_<?php echo $id . "/" . md5($images[$j]);?>" alt="...">
			    </div>
			    <?php }?>
			  </div>

			  <!-- Controls -->
			  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left"></span>
			  </a>
			  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right"></span>
			  </a>
		</div>
		
		<!-- User's name, surname and type -->
	        <blockquote class="blockquote-reverse">
	          	<h1><?php echo $row['title'] . "</h1>";
	          	echo "<h4>" . $row['category'] . "</h4>";
	          	echo "<footer><a href='view.php?u=" . $row['author'] . "'>" . $row['author'] . "</a></footer><br>";?>
	        </blockquote>
	</div>
	
	<!-- Map -->
	<div class="col-md-5 col-md-offset-1" id="gmap">
		<div id="map_canvas"></div>
	</div>
    </div>
    <div class="row">
	    <div class="col-md-6">
	    
	    		<!-- Report data -->
			<table class="table table-striped table-hover">
				<td><b class="text-muted">ΤΙΤΛΟΣ</b></td><td><?php echo $row['title'];?></td>
				<tr>
				  <td><b class="text-muted">ΚΑΤΗΓΟΡΙΑ</b></td><td><?php echo $row['category'];?></td>
				</tr>
				<tr> 
				  <td><b class="text-muted">ΠΕΡΙΓΡΑΦΗ</b></td><td><?php echo ($row['description']!=null) ? $row['description'] : '-';?></td>
				</tr>
				<tr>  
				  <td><b class="text-muted">ΚΑΤΑΣΤΑΣΗ</b></td><td><?php echo ' ' . $row['status'];?></td>
				</tr>
			</table>
	    </div>
	</div>
	<?php if (@$_SESSION['session_type'] == 'admin' && $row['status'] == 'Ανοικτό') {?>
	<br><br>
	
	<!-- Approve button, response modal and delete button -->
    <div class="row">
		<div class="col-md-5" >
			<button type="button" style="height:70px" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#myModal">Δηλώνω ότι η αναφορά είναι επιλυμένη...</button>
		</div>
		<div class="col-md-1" >
			<a class="text-danger" href="db/delete/delete_report.php?r=<?echo $_GET['r'];?>" onClick="return confirm('Σε περιπτωση που πατήσετε OK, αυτή η αναφορά θα διαγραφεί για ΠΑΝΤΑ');"><i class="fa fa-trash-o fa-lg"></i></a>
			<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="myModal" >
			  	<div class="modal-dialog modal-sm">
			    	<div class="modal-content">
			    		<form method="post" action="lib/solve.php" name="form">
			    			<div class="modal-header">
					        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        	<h4 class="modal-title" id="myModalLabel">Επιβεβαίωση επίλυσης</h4>
					      	</div>
					      	<div class="modal-body">
								<label for="description">Σχόλιο</label>
								<textarea class="form-control" rows="5" id="description" placeholder="Αφήστε ένα σχόλιο στον χρήστη που έκανε την αναφορά..." name="response"></textarea>
								<span class="help-block">Αν δεν θέλετε σχόλιο, αφήστε το κενο</span>
					      	</div>
					      	<input type="hidden" name="id" value="<?php echo $id;?>"></input>
					      	<input type="hidden" name="solver" value="<?php echo $_SESSION['session_username']?>"></input>
					      	<div class="modal-footer">
					        	<button type="button" class="btn btn-default" data-dismiss="modal">Ακύρωση</button>
				       	 		<button type="submit" onClick="return confirm('Η αναφορά θα θεωρηθεί οριστικά ως επιλυμένη');" class="btn btn-primary">Επιβεβαίωση</button>
					      	</div>
				      	</form>
			    	</div>
			  	</div>
			</div>
		</div>
	</div>
	<?php }?>
</div>

<!-- Map -->
<script src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script type="text/javascript">
	function map_single() {
	  var mylat = '<?php echo $row['lat'] ?>';
	  var mylng = '<?php echo $row['lng'] ?>';
	  var map = new google.maps.Map(document.getElementById("map_canvas"), {
	    center: new google.maps.LatLng(mylat, mylng),
	    zoom: 15,
	    mapTypeId: 'roadmap'
	  });
	  var marker = new google.maps.Marker({
	    position: new google.maps.LatLng(mylat, mylng),
	    map: map,
	    animation: google.maps.Animation.DROP,
	    draggable: false
	  }); 
	}
	window.onload = map_single;
</script>
<?php
include_once 'footer.html';
?>