<!DOCTYPE html>
<html>
<head>
  <title>Company Applicants</title>
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
  <h1>Company Applicants</h1>
<?php
session_start();

// check if user is logged in as company
if(!isset($_SESSION["comId"])) {
  echo "You need to log in to see this page.";
  header('Location: company.php');
  exit();
}
require_once 'dbconfig.php';

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// retrieve company id of logged-in user
$comId = $_SESSION["comId"];

// retrieve details of students who have applied to the company
$sql = "SELECT s.stRollno, s.stName, s.stWebmail, s.stPhone, a.status FROM student s INNER JOIN applied a ON s.stRollno = a.stRollno WHERE a.comId = '$comId'";
$result = mysqli_query($conn, $sql);

if ($result === false) {
  // handle query error
  echo "Error executing query: " . mysqli_error($conn);
} else if (mysqli_num_rows($result) > 0) {
    // display table headers
    echo "<table><tr><th>Student Roll No.</th><th>Student Name</th><th>Email</th><th>Phone No.</th><th>Status</th><th>Select</th></tr>";

    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $stRollno = $row["stRollno"];
      $status = $row["status"];
      echo "<tr><td>" . $row["stRollno"]. "</td><td>" . $row["stName"]. "</td><td>" . $row["stWebmail"]. "</td><td>" . $row["stPhone"]. "</td><td>" . $row["status"]. "</td>";

      if ($row["status"] == "under process") {
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='stRollno' value='" . $row["stRollno"] . "'>";
        echo "<td><button type='submit' name='select'>Select</button></td>";
        echo "</form>";
      } else {
        echo "<td>---</td>";
      }
  
      echo "</td></tr>";
    }
  // close table tag
  echo "</table>";
} else {
  echo "No results found.";
}
// handle select button click
if (isset($_POST["select"])) {
    $stRollno = $_POST["stRollno"];
    
  
    // update status column of corresponding row in applied table to "selected"
    $sql = "UPDATE applied SET status = 'selected' WHERE comId = '$comId' AND stRollno = '$stRollno'";
    $result = mysqli_query($conn, $sql);
  
    if ($result === false) {
      // handle query error
      echo "Error executing query: " . mysqli_error($conn);
    } else {
            // retrieve company id and name of logged-in user
    $sql2 = "SELECT comId, comName, salpack FROM company WHERE comId = '$comId'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $salpack =$row2["salpack"];
    $comId = $row2["comId"];    
    $comName = $row2["comName"];
            // get student's email
            $sql = "SELECT stWebmail FROM student WHERE stRollno = '$stRollno'";
        
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $to = $row['stWebmail'];
      
            // send email to student
            



            $subject = 'Congratulations! You have been selected.';
            $message = "Dear Student,\n\nCongratulations! We are pleased to inform you that you have been selected for the applied position in $comName.\nOffered CTC:$salpack LPA, you will be recieving offer letter from the recruiter's side soon.\nTill then we would request you to kindly update your student profile with this on tpc server as soon as possible.\n\nBest regards,\nTraining and Placement Cell \n IIT Patna";
            $headers = 'From: training.placement.iitp@company.com' . "\r\n" .
                'Reply-To: training.placement.iitp@company.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $message, $headers);
      
            // display success message and refresh the page
            echo "<script>alert('Student selected successfully. An email has been sent to the student.')</script>";
            echo "<meta http-equiv='refresh' content='0'>";
    }
  }
// close database connection
mysqli_close($conn);
?>
</body>
</html>