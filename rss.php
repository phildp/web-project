<?php
header('Content-Type: text/xml');
include_once 'db/connect.php';
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">';
echo '<atom:link href="http://it2014.panoikia.org/rss.php" rel="self" type="application/rss+xml" />';
echo '<channel>';
  echo '<title>It2014 - RSS feed</title>';
  echo '<link>http://it2014.panoikia.com</link>';

  $my_query = "SELECT * FROM reports ORDER BY id DESC LIMIT 20";

  $result = mysqli_query($mysql_con, $my_query) or die(mysql_error());

  while($row = mysqli_fetch_array($result)) {
    echo '<item>';
    	echo "<title>".$row['title']."</title>";
    	echo "<description>".$row['description']."</description>";
    	echo "<link>http://it2014.panoikia.com/report.php?r=".$row['id']."</link>";
    echo '</item>';
  }
echo '</channel>';
echo '</rss>';
?>