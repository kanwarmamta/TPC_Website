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
		float: left;
	font-size: 40px;
    margin-left:37%;
	margin-bottom: 10px;
	padding: 13px;
    align: 'centre';
    color: #191970;
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
<html>
    <head>
        <title>Companies Visited</title>
</head>
<body>
    <h1>Companies Visited</h1>
</body>
</html>
<?php 
require_once 'dbconfig.php';
  $sql = "SELECT c.comName, c.salpack, COUNT(a.status) AS numSelected FROM company AS c LEFT JOIN applied AS a ON c.comId = a.comId AND a.status = 'selected'GROUP BY c.comId, c.comName, c.salpack";


$result = mysqli_query($conn, $sql);
if (!$result) {
  die('Error executing query: ' . mysqli_error($conn));
}
if (mysqli_num_rows($result) > 0) {
echo "<table><tr><th>Company Name</th><th>Package (in LPA)</th><th>Number of Students Selected</th></tr>";
  while($row = mysqli_fetch_assoc($result)) {
      echo "<tr><td>" . $row["comName"]. "</td><td>" . $row["salpack"]. "</td><td>" . $row["numSelected"]. "</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}
?>