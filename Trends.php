<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Placement Trends</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
	    <link rel="stylesheet" href="View.css">
    </head>
    <body>
		<div class="box">
	<h1>Placement Trends</h1>
	<p></p>
	<input class="button" type="submit" value="Yearwise Placement" onClick="document.location.href='statsplacement_yr.php'" >
	<input class="button" type="submit" value="Branchwise Placement" onClick="document.location.href='statsplace_br.php'" >
	<input class="button" type="submit" value="Top 3 Packages Offered" onClick="document.location.href='statstop3.php'" >
	<input class="button" type="submit" value="Package Offered Trends" onClick="document.location.href='statsctc_trend.php'" >
	<input class="button" type="submit" value="Company Hiring Trends" onClick="document.location.href='statscom_hire.php'" >
	<input class="button" type="submit" value="Companies Visiting" onClick="document.location.href='statscom_visit.php'" >
	<input class="button" type="submit" value="Current Placement Branchwise" onClick="document.location.href='statsplace_branch.php'" >
	<input class="button" type="submit" value="General CTC Trend" onClick="document.location.href='statsctc_line.php'" >
	<input class="button" type="submit" value="TCS Trends" onClick="document.location.href='stats_tcs.php'" >
</div>

</body>
</html>
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
</html>