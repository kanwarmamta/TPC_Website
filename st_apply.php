<?php
require_once 'dbconfig.php';

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// retrieve data from form submission
$stRollno = $_SESSION["stRollno"];
$comId = $_POST["comId"];

// insert new row into applied table
$sql = "INSERT INTO applied (stRollno, comId) VALUES ('$stRollno', '$comId')";
if (mysqli_query($conn, $sql)) {
  echo "Application submitted successfully.";
} else {
  echo "Error submitting application: " . mysqli_error($conn);
}

// close database connection
mysqli_close($conn);
?>