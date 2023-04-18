<?php
session_start();
error_reporting(0);
require_once 'dbconfig.php';
$stRollno=$_SESSION["stRollno"];
$_SESSION["stRollnonew"] = $stRollno;
$stWebmail=$_SESSION["stWebmail"];
$_SESSION["stWebmailnew"] = $stWebmail;
$stName=$_SESSION["stName"];
$_SESSION["stNamenew"]=$stName;
$stPhone=$_SESSION["stPhone"];
$_SESSION["stPhonenew"]=$stPhone;
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: student.php");
}


if(isset($_POST['submit_query'])) {
    // Get the input data from the form
    $stquery = $_POST['stquery'];

    // Prepare the query
    $stmt = $conn->prepare("INSERT INTO stqueries (stRollno, stName, stWebmail, stquery, qStatus) VALUES (?, ?, ?, ?, ?)");

    // Bind the parameters to the prepared statement
    $stmt->bind_param("sssss", $stRollno, $stName, $stWebmail, $stquery, $qStatus);

    // Set the status to "pending"
    $qStatus = "pending";

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Query submitted successfully.');</script>";
    } else {
        echo "<script>alert('Error submitting query: " . $stmt->error . "');</script>";
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}
?>

<html lang="en">
    <head>
        <title>Welcome</title>
        <meta charset="UTF-8">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
	    <link rel="stylesheet" href="View.css">
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
                        <li><a href="Trends.php" class="dropdown" style="color:#f5f5f5;">Placement Statistics</a></li>
                        <li><a href="dbwelcome.php" class="dropdown" style="color:#f5f5f5;">Home</a></li> 
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
        <div class="box">
			<h1>Welcome, <?php echo $_SESSION["stName"]?>! </h1>
		    <input class="button" type="submit" name="e" value="Edit Profile" onClick="document.location.href='st_update.php'" >
		    <input class="button" type="submit" name="c" value="CPI Calculator" onClick="document.location.href='CPI_Calculator.php'" >
		    <input class="button" type="submit" name="el" value="Eligible" onClick="document.location.href='st_eligible.php'" >
            <input type="button" value="Raise a Query" class="button" onClick="showPrompt()" >
		    <input class="button" type="submit" name="d" value="Delete user" onClick="document.location.href='st_delete.php'" >
		    <input class="button" type="submit" name="l" value="Logout" onClick="document.location.href='st_logout.php'" >
        </div>
    <script>
        function storeQuery(stquery) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert("Query saved successfully");
                }
            };
            xhr.open("POST", "st_view.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("submit_query=1&stquery=" + stquery);
        }

        function showPrompt() {
            var stquery = window.prompt("Enter your query:");
            if (stquery != null && stquery.trim() !== "") {
        // Call a function to store the query in the table
        storeQuery(stquery);
    } else {
        alert("Error: Query cannot be empty.");
    }
        }
    </script>
</body>
</html>