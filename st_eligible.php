<!DOCTYPE html>

<html>

<head>

  <title>Student Company Results</title>

  <style>

    table {

      border-collapse: collapse;

      width: 100%;

    }

    th, td {

      text-align: left;

      padding: 8px;

    }

    th {

      background-color: #4CAF50;

      color: white;

    }

    tr:nth-child(even) {

      background-color: #f2f2f2;

    }

  </style>

</head>

<body>

  <h1>Student Company Results</h1>

<?php
session_start();

// check if user is logged in
if(!isset($_SESSION["stRollno"])) {
  echo "You need to log in to see this page.";
  exit();
}
require_once 'dbconfig.php';

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// retrieve data from student_company table for the logged-in student
$stRollno = $_SESSION["stRollno"];
$sql = "SELECT comId, comName FROM student_company WHERE stRollno = '$stRollno'";
$result = mysqli_query($conn, $sql);

if ($result === false) {
  // handle query error
  echo "Error executing query: " . mysqli_error($conn);
} else if (mysqli_num_rows($result) > 0) {
  // display table headers
  echo "<table><tr><th>Company ID</th><th>Company Name</th></tr>";

  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>" . $row["comId"]. "</td><td>" . $row["comName"]. "</td></tr>";
  }

  // close table tag
  echo "</table>";
} else {
  echo "No results found.";
}

// close database connection
mysqli_close($conn);
?>