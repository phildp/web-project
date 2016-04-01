<?php
	//------------- Check if the user is logged in -------------//
	if(!isset($_SESSION['session_username']) || (trim($_SESSION['session_username']) == '')) {
		$loggedin = FALSE;
	}else {
		$loggedin = TRUE;
	}
?>
<!DOCTYPE html>
<html>
  	<head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSS files -->
    	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css"/>
    	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"/>
	<link rel="stylesheet" href="css/bootstrapValidator.min.css"/>
    	<link rel="stylesheet" href="css/bootstrap.css"/>

	<!-- Required JS -->
	<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
	
    	<title>
    		<?php echo $title;?>
    	</title>
	</head>
  	<body>
  		<!-- The navbar -->
  		<div id="wrapper" style="min-height:100%; position:relative">
  		<nav class="navbar navbar-inverse navbar-fixed-top" id="navbar" role="navigation">
		  	<div class="container-fluid">
			  	<div class="container">
				    <!-- Brand and toggle get grouped for better mobile display -->
				    <div class="navbar-header">
				      	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigationbar">
					        <span class="sr-only">Toggle navigation</span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
				      	</button>
				      	<a class="navbar-brand" href="/"><span class="glyphicon glyphicon-home"></span></a>
				    </div>
			    	    <!-- Collect the nav links, forms, and other content for toggling -->
				    <div class="collapse navbar-collapse" id="navigationbar">
						<ul class="nav navbar-nav navbar-right">
						<?php if (!($loggedin)) {?>
							<li id="login" class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">Είσοδος<b class="caret"></b></a>
								<ul class="dropdown-menu inverse-dropdown" style="padding:10px; width:210px; color:#999">
									<li><?php include 'loginform.html';?></li>
								</ul>
							</li>
							<li>&nbsp;</li>
							<li><a href='registerform.php'>Εγγραφή</a></li>
						<?php } else {
							if (@$_SESSION['session_type'] == 'admin') {?>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">Διαχείριση</span><b class="caret"></b></a>
								<ul class="dropdown-menu inverse-dropdown" id="login">
									<li><a href="users_list.php">Χρήστες</a></li>
									<li class="divider-inverse"></li>
									<li><a href="archive.php?s=Ανοικτό">Ανοικτές αναφορές</a></li>
									<li><a href="archive.php?s=Κλειστό">Κλειστές αναφορές</a></li>
								</ul>
							</li>
							<?php }?>
							<li><a href="add_report.php"><span class="glyphicon glyphicon-plus"></span> Αναφορά</a></li>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user" /> <b><?php echo $_SESSION['session_username'];?></b><b class="caret"></b></a>
								<ul class="dropdown-menu inverse-dropdown">
									<li><a href="view.php?u=<?php echo $_SESSION['session_username'];?>">Προφίλ</a></li>
									<li><a href="archive.php?u=<?php echo $_SESSION['session_username'];?>">Οι αναφορές μου</a></li>
            						<li class="divider-inverse"></li>
									<li><a href='lib/logoff.php'>Έξοδος</a></li>
								</ul>
							</li>
						<?php }?>
						</ul>
				    </div><!-- /.navbar-collapse -->
				</div><!-- /.container -->
			</nav>
		<div class="content">
			<div class="container">
				<?php
				//------------- Check the user's permissions for the page  -------------//
				if(!($loggedin)) 
				{
					if ($pageperms == "forbidden" || $pageperms == "secure") 
					{
						$title = "403 - Forbidden";?>
						<h1>403 - Forbidden</h1></br>
						Δεν έχετε δικαίωμα πρόσβασης εδώ. Παρακαλώ συνδεθείτε ή <a href='registerform.php'>εγγραφείτε</a></div>
						<?php 
						include_once 'footer.html';
						exit();
					} 
					else {} #Welcome guest!...
				}
				else { #Welcome user/admin!...
					if ($pageperms == 'secure') 
					{//------------- Only for admins or for editing your own stuff -------------//
						if(($_SESSION['session_username'] != @$_GET['u']) && (trim($_SESSION['session_username']) != @$_GET['u']) && ($_SESSION['session_type'] != 'admin')) 
						{
							$title = "403 - Forbidden";?>
							<h1>403 - Forbidden</h1></br>
							Δεν έχετε δικαίωμα πρόσβασης εδώ. Μόνο διαχειριστές
							<?php 
							include_once 'footer.html';
							exit();	
						}
					}
				}?>
			</div><!-- /.container -->
                            
                            
                            
                            
                            