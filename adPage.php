<!DOCTYPE html>
<html>
<head>
  <title>Alumni Table</title>
  <form method="post">
		<input type="submit" name="show_data" value="Show Alumni Table">
        <input type="submit" name="show_comdata" value="Show Company Table">
        <input type="submit" name="show_stdata" value="Show Student Table">
        <input type="submit" name="show_applydata" value="Applied Student Status ">
        <input type="submit" name="show_selectdata" value="Selected Student Data">
	</form>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }
    
    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    
    tr:hover {
      background-color: #f5f5f5;
    }
    
    th {
      background-color: #4CAF50;
      color: white;
    }
  </style>
</head>
<body>
  <?php
  if(isset($_POST['show_data'])) {
    require_once 'dbconfig.php';

    $sql = "SELECT * FROM alumni";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      echo "<table><tr><th>Roll Number</th><th>Name</th><th>Email</th><th>Phone</th><th>CPI</th><th>Company (Previous)</th><th>CTC (Previous)</th><th>Area of Interest (Previous)</th><th>Role (Previous)</th><th>Location (Previous)</th><th>Tenure (Previous)</th><th>Company (Current)</th><th>CTC (Current)</th><th>Area of Interest (Current)</th><th>Role (Current)</th><th>Location (Current)</th><th>Tenure (Current)</th></tr>";
      while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["aRollno"]. "</td><td>" . $row["aName"]. "</td><td>" . $row["aEmail"]. "</td><td>" . $row["aPhone"]. "</td><td>" . $row["aCpi"]. "</td><td>" . $row["aCompP"]. "</td><td>" . $row["aCtcP"]. "</td><td>" . $row["aAreaIntP"]. "</td><td>" . $row["aRoleP"]. "</td><td>" . $row["aLocP"]. "</td><td>" . $row["aTenureP"]. "</td><td>" . $row["aCompC"]. "</td><td>" . $row["aCtcC"]. "</td><td>" . $row["aAreaIntC"]. "</td><td>" . $row["aRoleC"]. "</td><td>" . $row["aLocC"]. "</td><td>" . $row["aTenureC"]. "</td></tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }

    mysqli_close($conn);
}
if(isset($_POST['show_comdata'])) {
    require_once 'dbconfig.php';

    $sql = "SELECT * FROM company";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='table-divider'></div><table><tr><th>Company ID</th><th>Company Name</th><th>Email</th><th>Phone</th><th>Password</th><th>Required Candidates</th><th>Minimum Qualification</th><th>10th Criteria</th><th>12th Criteria</th><th>CPI Criteria</th><th>Salary Package</th><th>Mode of Hiring (On/Off Campus)</th><th>Mode of Hiring (Full Time/Internship)</th><th>Year of Recruitment</th></tr>";
      while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
        <td>" . $row["comId"]. "</td>
        <td>" . $row["comName"]. "</td>
        <td>" . $row["comEmail"]. "</td>
        <td>" . $row["comPhone"]. "</td>
        <td>" . $row["comPassword"]. "</td>
        <td>" . $row["reqCandi"]. "</td>
        <td>" . $row["minQual"]. "</td>
        <td>" . $row["10thCri"]. "</td>
        <td>" . $row["12thCri"]. "</td>
        <td>" . $row["cpiCri"]. "</td>
        <td>" . $row["salpack"]. "</td>
        <td>" . $row["mode"]. "</td>
        <td>" . $row["mode1"]. "</td>
        <td>" . $row["yearrec"]. "</td>
    </tr>";
    }
      echo "</table>";
    } else {
      echo "0 results";
    }

    mysqli_close($conn);
}
if(isset($_POST['show_stdata'])) {
    require_once 'dbconfig.php';

    $sql = "SELECT * FROM student";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='table-divider'></div><table><tr><th>Roll No.</th><th>Name</th><th>Webmail</th><th>Phone</th><th>Password</th><th>10th Percentage</th><th>12th Percentage</th><th>Current CPI</th><th>Age</th><th>Specialization</th><th>Interests</th><th>Batch</th><th>Placed</th><th>Package</th></tr>";
      while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
        <td>".$row['stRollno']."</td>
        <td>".$row['stName']."</td>
        <td>".$row['stWebmail']."</td>
        <td>".$row['stPhone']."</td>
        <td>".$row['stPassword']."</td>
        <td".$row['st10thPer']."</td>
        <td>".$row['st12thPer']."</td>
        <td>".$row['stcurrCpi']."</td>
        <td>".$row['stAge']."</td>
        <td>".$row['stSpec']."</td>
        <td>".$row['stInterest']."</td>
        <td>".$row['stBatch']."</td>
        <td>".$row['stPlaced']."</td>
        <td>".$row['stPack']."</td>
        </tr>";
    
    }
      echo "</table>";
    } else {
      echo "0 results";
    }

    mysqli_close($conn);
}
if(isset($_POST['show_applydata'])) {
    require_once 'dbconfig.php';

    $sql = "SELECT s.stRollno,s.stName,s.stBatch,c.comName, a.status  FROM student as s inner join applied as a on a.stRollno=s.stRollno  inner join company as c on c.comId=a.comId";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die('Error executing query: ' . mysqli_error($conn));
      }
    if (mysqli_num_rows($result) > 0) {
      echo "<table><tr><th>Roll Number</th><th>Student Name</th><th>Student Batch</th><th>Company Name</th><th>Status</th></tr>";
      while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["stRollno"]. "</td><td>" . $row["stName"]. "</td><td>" . $row["stBatch"]. "</td><td>" . $row["comName"]. "</td><td>" . $row["status"]. "</td></tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }
    $result = mysqli_query($conn, $sql);
// if (!$result) {
//   die('Error executing query: ' . mysqli_error($conn));
// }

    mysqli_close($conn);
}
if(isset($_POST['show_selectdata'])) {
    require_once 'dbconfig.php';

    $sql = "SELECT s.stRollno,s.stName,s.stBatch,c.comName,c.salpack FROM student as s inner join applied as a on a.stRollno=s.stRollno  inner join company as c on c.comId=a.comId and a.status='selected'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die('Error executing query: ' . mysqli_error($conn));
      }
    if (mysqli_num_rows($result) > 0) {
      echo "<table><tr><th>Roll Number</th><th>Student Name</th><th>Student Batch</th><th>Company Name</th><th>CTC Offered</th></tr>";
      while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["stRollno"]. "</td><td>" . $row["stName"]. "</td><td>" . $row["stBatch"]. "</td><td>" . $row["comName"]. "</td><td>" . $row["salpack"]. "</td></tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }
    $result = mysqli_query($conn, $sql);
// if (!$result) {
//   die('Error executing query: ' . mysqli_error($conn));
// }

    mysqli_close($conn);
}
  ?>
</body>
</html>