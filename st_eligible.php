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
  header('Location: student.php');
  exit();
}
require_once 'dbconfig.php';

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// retrieve data from student_company table for the logged-in student
$stRollno = $_SESSION["stRollno"];
$sql = "SELECT c.comId, c.comName FROM student s INNER JOIN company c ON s.stBatch = c.minQual WHERE s.st10thPer >= c.10thCri AND s.st12thPer >= c.12thCri AND s.stcurrCpi >= c.cpiCri AND s.stPack < c.salpack AND s.stRollno = '$stRollno'"; 
$result = mysqli_query($conn, $sql);

if ($result === false) {
  // handle query error
  echo "Error executing query: " . mysqli_error($conn);
} else if (mysqli_num_rows($result) > 0) {
  // display table headers
  echo "<table><tr><th>Company ID</th><th>Company Name</th><th>Apply</th></tr>";

  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $comId = $row["comId"];
    echo "<tr><td>" . $row["comId"]. "</td><td>" . $row["comName"]. "</td>";
    
    // check if the student has already applied to this company
    $checkSql = "SELECT * FROM applied WHERE stRollno = '$stRollno' AND comId = '$comId'";
    $checkResult = mysqli_query($conn, $checkSql);
    if (mysqli_num_rows($checkResult) > 0) {
      // student has already applied to this company
      echo "<td>Applied</td>";
    } else {
      // display "Apply" button and update applied table when clicked
      echo "<td><button onclick=\"location.href='?comId=$comId'\">Apply</button></td>";
      if (isset($_GET["comId"]) && $_GET["comId"] == $comId) {
        $applySql = "INSERT INTO applied (stRollno, comId) VALUES ('$stRollno', '$comId')";
        $applyResult = mysqli_query($conn, $applySql);
        if ($applyResult) {
          echo "<script>alert('Application submitted successfully.');</script>";
          echo "<meta http-equiv='refresh' content='0'>";
        } else {
          echo "Error submitting application: " . mysqli_error($conn);
        }
      }
    }
    echo "</tr>";
  }

  // close table tag
  echo "</table>";
} else {
  echo "No results found.";
}

// close database connection
mysqli_close($conn);
?>