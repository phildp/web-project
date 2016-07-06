<?php
  session_start();
  ob_start();
  $pageperms = 'forbidden';
  $title = 'Νέα Αναφορά';
  include_once 'header.php';
  include_once 'db/connect.php';

  $my_query = "SELECT * FROM categories";
  $result = mysqli_query($mysql_con, $my_query);
?>
<div class="container">
  <div class="page-header text-right">
    <h2>Νέα Αναφορά</h2>
  </div>
  <div class="col-md-6">
    <form enctype="multipart/form-data" role="form" method="post" action="db/add/submit_report.php">
      <div class="form-group">
        <label for="category">Κατηγορία *</label>
        <select class="form-control" name="category" id="category">
          <option value="">-Επιλέξτε κατηγορία-</option>
          <?php while ($row = mysqli_fetch_array($result)) {
            echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
          }?>
        </select>
      </div>
      <div class="form-group">
        <label for="title">Τίτλος *</label>
        <input type="text" class="form-control" id="title" placeholder="Τίτλος" name="title" />
      </div>
      <div class="form-group">
        <label for="description">Περιγραφή</label>
        <textarea class="form-control" name="description" rows="5" id="description "placeholder="Δώστε μια περιγραφή της κατάστασης που θέλετε να αναφέρετε..."></textarea>
      </div>
      <div class="form-group">
        <label for="gmap">Τοποθεσία *</label>
        <span class="help-block">Μπορείτε να επιτρέψτε στον περιηγητή να εντοπίσει την τοποθεσία σας</span>
      </div>
      <div class="form-group">
        <div id="gmap">
          <div id="map_canvas"></div>
        </div>
        <span class="help-block">Για να διορθώσετε τις συντεταγμένες, σύρτε τον δείκτη εκεί που θέλετε</span>
      </div>
      <div class="row">
        <div class="form-group col-md-3">
          <input name="lat" id="latitude" class="form-control input-sm" type="text" />
        </div>
        <div class="form-group col-md-3">
          <input name="lng" id="longitude" class="form-control input-sm" type="text" />
        </div>
      </div>
      <div class="form-group">
        <label for="image">Φόρτωση φωτογραφιών</label>
        <input type="file" name="image0" id="image" accept="image/*;capture=camera"></input>
        <input type="file" name="image1" id="image" accept="image/*;capture=camera"></input>
        <input type="file" name="image2" id="image" accept="image/*;capture=camera"></input>
        <input type="file" name="image3" id="image" accept="image/*;capture=camera"></input>
      </div>
      <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Υποβολή</button>
      <button type="reset" class="btn btn-danger"><span class="glyphicon glyphicon-ban-circle"></span> Καθαρισμός</button>
      <input type="hidden" name="submitted" value="TRUE" />
    </form>
  </div>
</div>
<?php
include_once 'footer.html';
?>
<!-- Javascripts for map and geolocation -->
<script src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script src="js/map_add.js"></script>
<script type="text/javascript">
  window.onload = map_add();
  window.onload = CallbackGeo2();
</script>

<!-- Javascripts for ajax validation -->
<script src="js/bootstrapValidator.min.js"></script>
<script src="js/my_validation2.js"></script>