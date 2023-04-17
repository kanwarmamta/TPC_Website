<!DOCTYPE html>
<html>
<head>

  <title>Placement trends</title>
  


  <form method="post">
		<input type="submit" class="my-button" name="show_placedyr" value="Placement Yearwise">
    <input type="submit" class="my-button" name="show_placedbr" value="Placement Branchwise">
        <input type="submit" class="my-button" name="show_com" value="Companies Visting">
        <input type="submit" class="my-button" name="show_comno" value="No. of Companies each year">
        <input type="submit"class="my-button" name="show_stdata" value="Company Hiring Trends"> 
        <!-- //offers -->
                <input type="submit" class="my-button" name="show_applydata" value="CTC Offered trends">
        <!-- <input type="submit" class="my-button" name="show_selectdata" value="Selected Student Data">
        <input type="submit" class="my-button" name="show_sqldata" value="Data acc. to SQL queries"> -->
        
	</form>
  
  

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-color: #f5f5f5;
		}

	header {
		background-color: #333;
		color: #191970;
		padding: 10px;
		text-align: center;
		margin-bottom: 0px;
	}

	h1 {
		margin: 0;
		font-size: 16px;
		/* font-weight: bold;
		text-transform: uppercase; */
	}

	.container {
		margin: 0 auto;
		padding: 1px;
		max-width: 50px;
	}

	form {
		display: flex;
		/* justify-content: space-between; */
		align-items: center;
		margin-bottom:0px;
	}

	form input[type="submit"] {
		padding: 10px 20px;
		font-size: 16px;
		/* font-weight: bold; */
		color: #191970;
		background-color: #fff;
		border: none;
		border-radius: 5px;
		cursor: pointer;
	}

	form input[type="submit"]:hover {
		background-color: #191970;
    color: #fff;
	}

	textarea {
		width: 100%;
		padding: 10px;
		border-radius: 5px;
		border: 4px solid #191970;
		resize: vertical;
	}

	table {
		border-collapse: collapse;
		width: 100%;
		margin-bottom: 0px;
	}

	th, td {
		padding: 10px;
		text-align: left;
		border-bottom: 1px solid #ddd;
	}
  

	/* tr:hover {
      background-color: #f5f5f5;
    } */
	th {
		background-color: #191970;
		color: white;
		/* font-weight: bold;
		text-transform: uppercase; */
	}
  #ctcChart {
    width: 10px;
    height: 10px;
}
  .my-button {
  background-color: #fff;
  color: #191970;
}
.new-button {
  background-color: #fff; 
  color: #191970; /* White text */
  border: none; /* Remove borders */
  padding: 10px 20px; /* Add padding */
  text-align: center; /* Center text */
  text-decoration: none; /* Remove underline */
  display: inline-block; /* Make it a block element */
  font-size: 16px; /* Increase font size */
  cursor: pointer; /* Add cursor on hover */
  border-radius: 4px; /* Add rounded corners */
}


</style>
</head>
<body>
<canvas id="ctcChart" width="10px" height="10px"></canvas>
  <?php
  if(isset($_POST['show_placedyr'])) {
   
    require_once 'dbconfig.php';

    <?php

include_once("includes/db_connect.php");

?>

<html>

    <head>

        <!--chart js -->

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    </head>

    <body>

         <?php

      $chkresults = mysqli_query($conn,"SELECT MONTH(subscribed_on) AS subscriber_month, COUNT(*) AS subscriber_count FROM subscribers GROUP BY MONTH(subscribed_on)");    

      ?>

    <script type="text/javascript">

      google.charts.load('current', {'packages':['Bar']});

      google.charts.setOnLoadCallback(drawChart);

 

      function drawChart() {

        var data = google.visualization.arrayToDataTable([

           ['Month','Subscribers'],

         <?php     

        while($row=mysqli_fetch_assoc($chkresults)){            

           echo "['".$row["subscriber_month"]."',".$row["subscriber_count"]."],";

          }

         ?>

        ]);

        var options = {

          chart: {

            title: '',          

          },

          bars: 'vertical',

          vAxis: {format: 'decimal'},

          height: 300,

          colors: ['#d95f02']

        };

        var chart = new google.charts.Bar(document.getElementById('bar-graph-location'));

        chart.draw(data, google.charts.Bar.convertOptions(options));

      }

    </script>     

        <!--location where bar graph will be displayed-->

        <div id="bar-graph-location">

        </div>

    </body>

</html>
   

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
if(isset($_POST['show_custom_query'])) {
  require_once 'dbconfig.php';

  // Get custom query input from user
$query = $_POST['custom_query'];
// Check if query is empty
if(empty($query)) {
  die('Error: Query is empty');
}
// Sanitize the input query
$query = mysqli_real_escape_string($conn, $_POST['custom_query']);

// Execute the query
$result = mysqli_query($conn, $query);
if (!$result) {
  die('Error executing query: ' . mysqli_error($conn));
}

// Get number of columns in the query result
$num_cols = mysqli_num_fields($result);

// Print table header
echo "<table>";
echo "<tr>";
for ($i = 0; $i < $num_cols; $i++) {
    $col_name = mysqli_fetch_field_direct($result, $i)->name;
    echo "<th>".$col_name."</th>";
}
echo "</tr>";

// Loop through results and print each row in table
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    for ($i = 0; $i < $num_cols; $i++) {
        echo "<td>".$row[mysqli_fetch_field_direct($result, $i)->name]."</td>";
    }
    echo "</tr>";
}

// Close the table
echo "</table>";

// Close the database connection
mysqli_close($conn);
}


  ?>
</body>
</html>