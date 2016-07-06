<?php
session_start();
ob_start();
$pageperms = 'secure';
$title = 'Το προφίλ μου';
include_once 'header.php';
include_once 'db/connect.php';

$u = @$_GET['u'];
$query = "SELECT * FROM users WHERE uname = '$u'";
$result = mysqli_query($mysql_con, $query);

if(mysqli_num_rows($result) == 0) // User not found.
{
	echo '<div class="container">';
  echo '<h2>User not found</h2>';
  echo '</div>';
  include_once 'footer.php';
  die();
}

$row = mysqli_fetch_array($result); 

$query2 = "SELECT * FROM reports WHERE author = '$u'";

$result2 = mysqli_query($mysql_con, $query2);
$reps = mysqli_num_rows($result2);
?>
<div class="container">
  <div class="row">
    <div class="col-md-5">
      <img src="uploads/<?php echo md5('default_avatar.png');?>" alt="avatar.jpg" class="img-circle img-responsive col-xs-offset-2"><br>
      <blockquote class="blockquote-reverse">
        <h1><?php echo $row['name'] . ' ' . $row['surname'];?></h1>
        <footer><?php echo $row['type'];?></footer><br>
      </blockquote>
    </div>
  </div>
  <div class="col-md-5">
    <table class="table table-striped table-hover" id="myTable">
      <tr>
        <td><b class="text-muted">ΟΝΟΜΑ</b></td><td><a id='name' class='editable' data-url='db/update/update.php' data-type='text' data-pk="<?php echo $row['uname'];?>"><?php echo ' ' . $row['name'];?></a><br></td>
      </tr>
      <tr>
        <td><b class="text-muted">ΕΠΩΝΥΜΟ</b></td><td><a id='surname' class='editable' data-url='db/update/update.php' data-type='text' data-pk="<?php echo $row['uname'];?>"><?php echo ' ' . $row['surname'];?></a><br></td> 
      </tr>
      <tr>
        <td><b class="text-muted">ΟΝΟΜΑ ΧΡΗΣΤΗ</b></td><td><?php echo ' ' . $row['uname'];?><br></td>  
      </tr>
      <tr>
        <td><b class="text-muted">EMAIL</b></td><td><a href="mailto:<?php echo $row['email'];?>"><?php echo ' ' . $row['email'];?></a><br></td>  
      </tr>
      <tr>
        <td><b class="text-muted">ΤΗΛΕΦΩΝΟ</b></td><td><a id='phone' class='editable' data-url='db/update/update.php' data-type='text' data-pk="<?php echo $row['uname'];?>"><?php echo ' ' . (($row['phone']!=null) ? $row['phone'] : '-');?></a><br></td>  
      </tr>
      <tr>
        <td><b class="text-muted">ΑΝΑΦΟΡΕΣ</b></td><td><a href="archive.php?u=<?php echo $u;?>"><?php echo ' ' . (($reps!=0) ? $reps : '-');?></a></td>
      </tr> 
    </table><br>
      <button id="toggle" type="button" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> Επεξεργασία</button>
  <br><br><a class="small" onClick="return confirm('Σε περιπτωση που πατήσετε OK, ο χρήστης ´<?php echo $row['uname'];?>´ θα διαγραφεί για ΠΑΝΤΑ');"   href="db/delete/delete_user.php?u=<?php echo $u;?>">Διαγραφή του λογαριασμού</a>
  </div>
  <div class="col-md-4">
    <div class="well alert-info" style="margin-top:20px">
        <i class="fa fa-info-circle fa-3x pull-left"></i><i>Για να επικυρώσετε τις αλλαγές στα στοιχεία σας κάντε <strong>refresh</strong> τη σελίδα</i>
    </div>
  </div>
</div>
<?php
include_once 'footer.html';
?>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script>
  $.fn.editable.defaults.mode = 'inline';
  $('#toggle').click(function() {
        $('#myTable .editable').editable('toggleDisabled');
        $('#toggle').toggleClass('active');
    });
  $('#myTable .editable').editable('disable');
</script>