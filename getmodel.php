<?php
include('dbconn.php');

$make = $_POST['make'];
$year = $_POST['year'];

$query = "SELECT DISTINCT `Model` FROM `cars` WHERE make = '$make' AND Year = '$year'";
$result = mysqli_query($connection, $query);

$options = "<option value=''>Model</option>";
while ($row = mysqli_fetch_assoc($result)) {
  $options .= "<option value='{$row['Model']}'>{$row['Model']}</option>";
}

echo $options;
?>
