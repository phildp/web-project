<?php
include_once ('../db/connect.php');

$dom = new DOMDocument("1.0", "UTF-8");
$node = $dom->createElement("reports");
$parnode = $dom->appendChild($node);

$query = "SELECT * FROM reports WHERE status = 'Ανοικτό' ORDER BY id DESC LIMIT 20";
$result = mysqli_query($mysql_con, $query);

if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = @mysqli_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  $node = $dom->createElement("report");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("title",$row['title']);
  $newnode->setAttribute("category", $row['category']);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("lng", $row['lng']);
  $newnode->setAttribute("id", $row['id']);
}
$dom->FormatOutput = true;
echo $dom->saveXML();
?>