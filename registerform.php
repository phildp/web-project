<?php
session_start();
//ob_start();
$pageperms = 'safe';
$title = 'Εγγραφή χρήστη';
include_once 'header.php';
?>
<div class="container">
	<div class="page-header text-right">
		<h2>Εγγραφή </h2>
	</div>
	<div class="col-md-4">
		<form id="form" role="" method="post" name="form" action="db/add/register.php">
			<div class="form-group">
				<label for="fname">Όνομα *</label>
				<input type="text" class="form-control" id="fname" placeholder="John" name="fname">
		  	</div>
			<div class="form-group">
				<label for="lname">Επώνυμο *</label>
				<input type="text" class="form-control" id="lname" placeholder="Doe" name="lname">
		  	</div>
			<div class="form-group">
				<label for="uname">Όνομα χρήστη *</label>
				<input type="text" class="form-control" id="uname" placeholder="johndoe" name="uname">
		  	</div>
			<div class="form-group">
				<label for="lname">Email *</label>
				<input type="email" class="form-control" id="email" placeholder="john@doe.com" name="email">
		  	</div>
			<div class="form-group">
	                	<label for="pass">Τηλέφωνο</label>
	                	<input type="tel" class="form-control" id="phone" placeholder="6999999999" name="phone">
	            	</div>
		  	<div class="form-group">
			    <label for="pass">Κωδικός *</label>
			   	<input type="password" class="form-control" id="pass" placeholder="&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;" name="pass">
		  	</div>
            <div class="form-group">
                <label for="pass">Επιβεβαίωση κωδικού *</label>
                <input type="password" class="form-control" id="confpass" placeholder="&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;" name="confirmpass">
            </div>
			<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Εγγραφή</button>
			<input type="reset" class="btn btn-danger" value="Καθαρισμός"></input>
		</form>
	</div>
</div>
<?php
    include_once 'footer.html';
?>
<!-- Javascripts for ajax validation -->
<script src="js/bootstrapValidator.min.js"></script>
<script src="js/my_validation.js"></script>