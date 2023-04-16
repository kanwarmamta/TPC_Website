<?php
session_start();
error_reporting(0);

// Check if the user is logged in
if(!isset($_SESSION["comId"]))
{
    header('Location: company.php');
    exit;
}

// Connect to the database
require_once 'dbconfig.php';

$result=true;

if ($result)
{
    //Check if the user confirmed the deletion
    if($_GET["confirm"]=="yes")
    {
        // Delete the user's information from the "users" table
        $sql = "DELETE FROM company WHERE comId = '".$_SESSION['comId']."'";
        $result=$conn->query($sql);

        // Destroy the session and redirect to the login page
        session_destroy();
        header('Location: com_register.php');
        exit;
    }
    else if($_GET["confirm"]=="no")
    {
        // Redirect to the profile page
        header('Location: com_view.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Delete Account</title>
        <meta charset="UTF-8">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
	    <link rel="stylesheet" href="Delete.css">
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
        <form action="company.php" method="get">
            <div class="delete-box">
                <h1>Delete Account</h1>
                <p style="font-size: 25px;">Do you want to delete your account? </p>
                <label for="confirm-yes" class="container">YES
                    <input type="radio" id="confirm-yes" name="confirm" value="yes">
                    <span class="check"></span>
                </label>
                <label for="confirm-no" class="container">NO
                    <input type="radio" id="confirm-no" name="confirm" value="no" checked>
                    <span class="check"></span>
                </label>
                <input class="button" type="submit" name="confirm" value="Confirm">
            </div>
        </form>
    </body>
</html>