<?php
session_start();
error_reporting(0);
$errors = array();

// Check if the user is logged in
if(!isset($_SESSION["aRollno"]))
{
    header('Location: alumni.php');
    exit;
}

// Connect to the database
require_once 'dbconfig.php';

// Handle form submission
if(isset($_GET["submit"]))
{
    // Get the user's current information
    $curraRollno= $_SESSION['aRollno'];
    $sql = "SELECT * FROM alumni WHERE aRollno=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $curraRollno);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    // Get the user's updated information
    $aRollno=$_GET["aRollno"];
    $aName=$_GET["aName"];
    $aEmail=$_GET["aEmail"];
    $aPhone=$_GET["aPhone"];
    $aPwd=$_GET["aPassword"];
    $aCpi=$_GET["aCpi"];
    $aBatch=$_GET["aBatch"];
    $aCompP=$_GET["aCompP"];
    $aCtcP=$_GET["aCtcP"];
    $aAreaIntP=$_GET["aAreaIntP"];
    $aRoleP=$_GET["aRoleP"];
    $aLocP=$_GET["aLocP"];
    $aTenureP=$_GET["aTenureP"];
    $aCompC=$_GET["aCompC"];
    $aCtcC=$_GET["aCtcC"];
    $aAreaIntC=$_GET["aAreaIntC"];
    $aRoleC=$_GET["aRoleC"];
    $aLocC=$_GET["aLocC"];
    $aTenureC=$_GET["aTenureC"];

    if(strlen(trim($aPwd))<8)
    {
        echo '<script>alert("Password should be at least 8 characters long."); </script>';
        exit;
    }
    
    if (!isset($_GET['decl']) || $_GET['decl'] != 'accepted')
    {
        echo '<script>alert("You must accept the declaration to edit profile.");</script>';
    }
    else
    {
        // Update the user's information in the "users" table
        $sql = "UPDATE alumni SET aRollno=?, aName=?, aEmail=?, aPhone=?, aPassword=?, aCpi=?, aBatch=?, aCompP=?, aCtcP=?, aAreaIntP=?, aRoleP=?, aLocP=?, aTenureP=?,aCompC=?, aCtcC=?, aAreaIntC=?, aRoleC=?, aLocC=?, aTenureC=? WHERE aRollno=?";   //left here
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssssssssssss", $aRollno, $aName, $aEmail, $aPhone, $aPwd, $aCpi, $aBatch, $aCompP, $aCtcP, $aAreaIntP, $aRoleP, $aLocP, $aTenureP, $aCompC, $aCtcC, $aAreaIntC, $aRoleC, $aLocC, $aTenureC, $curraRollno);
        $stmt->execute();
        echo '<script>alert("Successfully Updated."); window.location.href = "Alu_view.php";</script>';
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Information</title>
        <meta charset="UTF-8">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
	    <link rel="stylesheet" href="Update.css">
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

        <form action="Alu_update.php" method="get">
            <div class="update-box">
			    <h1>Edit Profile</h1>
                <table>
                    <tr>
                        <td class="tdLabel"><label for="aRollno" class="label" style="font-size:20px; color:#191970;">Roll Number:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="Roll Number" name="aRollno" value="" maxlength="8"></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="aName" class="label" style="font-size:20px; color:#191970;">Name:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="Name" name="aName" value="" maxlength="50"></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="aEmail" class="label" style="font-size:20px; color:#191970;">E-mail:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="E-mail" name="aEmail" value="" maxlength="100"></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="aPhone" class="label" style="font-size:20px; color:#191970;">Phone Number:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="Phone Number" name="aPhone" value="" maxlength="10"></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="aPassword" class="label" style="font-size:20px; color:#191970;">Password:</label></td>
                        <td><div class="textbox"><input type="password" placeholder="Password" name="aPassword" value="" maxlength="20"></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="aCpi" class="label" style="font-size:20px; color:#191970;">CPI:</label></td>
                        <td><div class="textbox"><input type="number" placeholder="CPI" name="aCpi" value="" step="0.01" maxlength="5"></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="aBatch" class="label" style="font-size:20px; color:#191970;">Batch:</label></td>
                        <td><div class="textbox"><input type="number" placeholder="YYYY" name="aBatch" value="" min="2008" max="2022">
                            <script>
                                document.querySelector("input[type=number]")
                                .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
                            </script>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="aCompP" class="label" style="font-size:20px; color:#191970;">First Company Joined:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="First Company Joined" name="aCompP" maxlength="50"/></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="aCtcP" class="label" style="font-size:20px; color:#191970;">First CTC:</label></td>
                        <td><div class="textbox"><input type="number" placeholder="First CTC" name="aCtcP"/></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="aAreaIntP" class="label" style="font-size:20px; color:#191970;">Area of interest</label></td>
                        <td><div class="textbox"><input type="text" placeholder="Area of interest" name="aAreaIntP" maxlength="100"/></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="aRoleP" class="label" style="font-size:20px; color:#191970;">First Company Role:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="First Company Role" name="aRoleP" maxlength="100"/></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="aLocP" class="label" style="font-size:20px; color:#191970;">First Company Location:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="First Company Location" name="aLocP" maxlength="100"/></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="aTenureP" class="label" style="font-size:20px; color:#191970;">First Company Tenure:</label></td>
                        <td><div class="textbox"><input type="number" name="aTenureP" placeholder="First Company Tenure"></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="aCompC" class="label" style="font-size:20px; color:#191970;">Current Company:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="Current Company" name="aCompC" maxlength="50"/></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="aCtcC" class="label" style="font-size:20px; color:#191970;">Current CTC:</label></td>
                        <td><div class="textbox"><input type="number" placeholder="Current CTC" name="aCtcC"/></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="aAreaIntC" class="label" style="font-size:20px; color:#191970;">Area of interest</label></td>
                        <td><div class="textbox"><input type="text" placeholder="Area of interest" name="aAreaIntC" maxlength="100"/></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="aRoleC" class="label" style="font-size:20px; color:#191970;">Current Company Role:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="Current Company Role" name="aRoleC" maxlength="100"/></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="aLocC" class="label" style="font-size:20px; color:#191970;">Current Company Location:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="Current Company Location" name="aLocC" maxlength="100"/></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="aTenureC" class="label" style="font-size:20px; color:#191970;">Current Company Tenure:</label></td>
                        <td><div class="textbox"><input type="number" name="aTenureC" placeholder="Current Company Tenure"></td>
                    </tr>

                </table>
                <div class="checkbox">
				    <label><input type="checkbox" name="decl" value="accepted"><b>I declare that the information given by me is true to my knowledge.</b></label>
			    </div>

			    <input class="button" type="submit" name="submit" value="Update">
		
            </div>
        </form>
    </body>
</html>