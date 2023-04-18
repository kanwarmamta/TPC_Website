<?php
session_start();

// check if user is logged in
if(!isset($_SESSION["comId"])) {
  echo "You need to log in to see this page.";
  header('Location: company.php');
  exit();
}

require_once 'dbconfig.php';

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// retrieve data from applied table for the logged-in company
$comId = $_SESSION["comId"];
$sql = "SELECT a.stRollno, s.stName, s.stWebmail, s.stPhone FROM applied a INNER JOIN student s ON a.stRollno = s.stRollno WHERE a.comId = '$comId'"; 
$result = mysqli_query($conn, $sql);

if ($result === false) {
  // handle query error
  echo "Error executing query: " . mysqli_error($conn);
} else if (mysqli_num_rows($result) > 0) {
  // display table headers
  echo "<table><tr><th>Student Roll No</th><th>Name</th><th>Email</th><th>Phone</th><th>Select</th></tr>";

  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>" . $row["stRollno"]. "</td><td>" . $row["stName"]. "</td><td>" . $row["stWebmail"]. "</td><td>" . $row["stPhone"]. "</td><td><form method='post'><input type='hidden' name='stRollno' value='" . $row["stRollno"] . "'><input type='submit' name='select' value='" . ($row["selected"] == 'y' ? 'Selected' : 'Select') . "'></form></td></tr>";
  }

  // close table tag
  echo "</table>";
} else {
  echo "No results found.";
}

// check if select button is clicked
if (isset($_POST["select"])) {
  $stRollno = $_POST["stRollno"];

  // update selected column in applied table
  $sql = "UPDATE applied SET selected = 'y' WHERE comId = '$comId' AND stRollno = '$stRollno'";
  $result = mysqli_query($conn, $sql);

  if ($result === false) {
    // handle query error
    echo "Error executing query: " . mysqli_error($conn);
  } else {
    // display success message
    echo "Selected successfully.";
  }
}

// close database connection
mysqli_close($conn);
?>
