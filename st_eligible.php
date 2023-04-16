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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="navbar.css">
</head>

<body>
    <!--Navigation bar-->
    <nav class="navbar navbar-default navbar-fixed-top" style="background-color:#191970;">
            <div class="container">
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
        
                    <div class="col-md-3 col-sm-6 col-xs-12 left" id ="left">  
                        <img src="col_logo.png" width="100px" height="100px" id=logo alt="Logo image" style="margin-left: 0px;" />
                    </div>
                    <a class="navbar-brand" href="dbwelcome.php" style="color:white;font-size:155%;"><span> Training and Placement Cell, IIT Patna</span></a>
                    <br>
                    <a class="navbar-brand" href="dbwelcome.php" style="color:white;font-size:155%;font-family:KrutiDev;"><span> प्रशिक्षण एवं स्थानन प्रकोष्ठ</span></a>
                    <!-- <a class="navbar-brand" href="dbwelcome.php" style="color:white;font-size:155%;font-family:KrutiDev;"><span> प्रशिक्षण एवं स्थानन प्रकोष्ठ, आईआईटी पटना</span></a> -->
                </div>
                <div class="collapse navbar-collapse" id="myNavbar" >
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="Trends.php" class="dropbtn" style="color:#f5f5f5;">Placement Statistics</a></li>
                        <li><div class="dropdown">
                            <a href="#" class="dropbtn" style="color:#f5f5f5;">Login</a>
                            <div class="dropdown-content">
                                <a href="student.php">Student</a>
                                <a href="company.php">Company</a>
                                <a href="alumni.php">Alumni</a>
                                <a href="admin.php">Admin</a>
                                <a href="tpo.php">TPO</a>
                            </div>
                        </div></li>   
                    </ul>
                </div>
            </div>
        </nav>
        <!--/ Navigation bar-->

        <!-- Banner-->
        <div class="banner">
            <div class="bg-color">
                <div class="container">
                    <div class="row">
                        <div class="banner-text text-center">
                            <div class="text-border">
                                <h2 class="text-dec">Learn To Code</h2>
                            </div>
                            <div class="intro-para text-center quote">
                                <p><br><br></p>
                            </div>
                            <a href="#feature" class="mouse-hover">
                                <div class="mouse"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Banner-->
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