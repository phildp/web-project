<?php
	session_start();
	ob_start();
	//------------- Set the title, page requirements and include header.php -------------//
	$title = 'Welcome';
	$pageperms = "safe";
	include_once 'header.php';
	include_once 'db/connect.php';
	//------------- Select the open reports for the map -------------//
	$query = "SELECT * FROM reports WHERE status = 'Ανοικτό' ORDER BY id DESC LIMIT 3";
	$result = mysqli_query($mysql_con, $query);
?>
<div class="new-header">
	<div class="container">
		<hr>
		<h2>Εφαρμογή Διαχείρισης Περιστατικών σε Χωρους Εστίασης Πάτρας</i></h2>
		<hr>
	</div>
</div>
<div class="container" id="gmap">
	<div id="map_canvas"></div>
</div>
<br><br><br>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-info">
				<!-- Page statistics -->
				<div class="panel-heading">
					<strong>Στατιστικά στοιχεία</strong><a onClick="refresh()"><i class="fa fa-refresh pull-right"></i></span></a>
				</div>
				<ul class="list-group">
					<li class="list-group-item">Συνολικός αριθμός αναφορών: <b id="all"></b></li>
					<li class="list-group-item">Συνολικός αριθμός ανοικτών αναφορών: <b id="open"></b></li>
					<li class="list-group-item">Συνολικός αριθμός επιλυμένων αναφορών: <b id="cl"></b></li>
					<li class="list-group-item">Μέσος χρόνος επίλυσης αναφορών: <b id="med"></b></li>
				</ul>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-info">
			<!-- Latest reports -->
				<div class="panel-heading"><strong>Πρόσφατα</strong></div>
				<ul class="list-group">
				<?php while($row = mysqli_fetch_array($result)) {
					$images = explode(',', $row['image']);?>
					<li class="list-group-item">
						<div class="media">
						  	<a class="pull-left" href="report.php?r=<?php echo $row['id'];?>">
						  	<?php if ($images[0] != 'no-photo.png') {?>
					      		<img class="media-object" style="height:64px;width:64px;" src="uploads/report_<?php echo $row['id'] . '/' . md5($images[0]);?>" alt="avatar.png" />
						  	<?php }
					    	else {?>
					      		<img class="media-object" style="height:64px;width:64px;" src="uploads/<?php echo md5($images[0]);?>" alt="avatar.png" />
						  	<?php }?>
						    </a>
						  	<div class="media-body">
							    	<h4 class="media-heading"><?php echo $row['title'];?></h4>
							    	<i><?php echo $row['category'];?></i>
							    	<p class="text-muted"><?php echo $row['description'];?></p>
						  	</div>
						</div>
					</li>
				<?php }?>
				</ul>
			</div>
		</div>
	</div>
	<div class="alert alert-info">
		<p class="text-center">Μπορείτε να παρακολουθείτε τις <strong>20 τελευταίες αναφορές</strong> μέσω <button class="btn btn-warning btn-xs" onClick="location.href='rss.php'">RSS <i class="fa fa-rss fa-lg"></i></button></p>
	</div>
</div>
<!-- Javascripts for the map -->
<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="js/map_index.js"></script>

<!-- Javascript for dynamically refreshing the statistics -->
<script src="js/refresh.js"></script>

<!-- Javascript to start the functions (map, refresh) -->
<script>
function start() {
	map_index();
	refresh();
}
window.onload = start;
</script>
<?php 
	include_once 'footer.html';
?>