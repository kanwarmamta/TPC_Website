<?php
session_start();
error_reporting(0);
$errors = array();

// Check if the user is logged in
if(!isset($_SESSION["comId"]))
{
    header('Location: company.php');
    exit;
}

// Connect to the database
require_once 'dbconfig.php';

// Handle form submission
if(isset($_GET["submit"]))
{
    // Get the user's current information
    $currcomId= $_SESSION['comId'];
    $sql = "SELECT * FROM company WHERE comId=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $currcomId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    // Get the user's updated information
    $comId=$_GET["comId"];
    $comName=$_GET["comName"];
    $comEmail=$_GET["comEmail"];
    $comPhone=$_GET["comPhone"];
    $comPwd=$_GET["comPassword"];
    $reqCandi=$_GET["reqCandi"];
    $minQual=$_GET["minQual"];
    $Cri10=$_GET["10thCri"];
    $Cri12=$_GET["12thCri"];
    $cpiCri=$_GET["cpiCri"];
    $salpack=$_GET["salpack"];
    $mode=$_GET["mode"];
    $mode1=$_GET["mode1"];
    $yearrec=$_GET["yearrec"];

    if(strlen(trim($comPwd))<8)
    {
        echo "Password should be at least 8 characters long.";
        exit;
    }

    if (!isset($_GET['decl']) || $_GET['decl'] != 'accepted')
    {
        echo "You must accept the declaration to edit profile.";
    }
    else
    {
        // Update the user's information in the "users" table
        $sql = "UPDATE company SET comId=?, comName=?, comEmail=?, comPhone=?, comPassword=?, reqCandi=?, minQual=?, 10thCri=?, 12thCri=?, cpiCri=?, salpack=?, mode=?, mode1=?, yearrec=? WHERE comId=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssssssss", $comId, $comName, $comEmail, $comPhone, $comPwd, $reqCandi, $minQual, $Cri10, $Cri12, $cpiCri, $salpack, $mode, $mode1, $yearrec, $currcomId);
        $stmt->execute();
        echo "Successfully Updated.";
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

        <form action="com_update.php" method="get">
            <div class="update-box">
			    <h1>Edit Profile</h1>
                <table>
                    <tr>
                        <td class="tdLabel"><label for="comId" class="label" style="font-size:20px; color:#191970;">Company Id:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="Company ID" name="comId" value="" maxlength="6"></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="comName" class="label" style="font-size:20px; color:#191970;">Company Name:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="Company Name" name="comName" value="" maxlength="50"></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="comEmail" class="label" style="font-size:20px; color:#191970;">E-mail:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="E-mail" name="comEmail" value="" maxlength="100"></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="comPhone" class="label" style="font-size:20px; color:#191970;">Phone Number:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="Phone Number" name="comPhone" value="" maxlength="10"></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="comPassword" class="label" style="font-size:20px; color:#191970;">Password:</label></td>
                        <td><div class="textbox"><input type="password" placeholder="Password" name="comPassword" value="" maxlength="20"></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="reqCandi" class="label" style="font-size:20px; color:#191970;">Required Candidates:</label></td>
                        <td><div class="textbox"><input type="number" placeholder="Required Candidates" name="reqCandi" value="" ></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="minQual" class="label" style="font-size:20px; color:#191970;">Graduating Year:</label></td>
                        <td><div class="textbox"><input type="number" placeholder="YYYY" name="minQual" value="" min="2023" max="2026">
                            <script>
                                document.querySelector("input[type=number]")
                                .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
                            </script>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="10thCri" class="label" style="font-size:20px; color:#191970;">Grade 10 Marks Criteria:</label></td>
                        <td><div class="textbox"><input type="number" placeholder="Grade 10 Marks Criteria" step="0.01" name="10thCri" maxlength="5"/></div></td>
                    </tr>
                    <tr>
                        <td class="tdLabel"><label for="12thCri" class="label" style="font-size:20px; color:#191970;">Grade 12 Marks Criteria</label></td>
                        <td><div class="textbox"><input type="number" placeholder="Grade 12 Marks Criteria" step="0.01" name="12thCri" maxlength="5"/></div></td>
                    </tr>
                    <tr>
                        <td class="tdLabel"><label for="cpiCri" class="label" style="font-size:20px; color:#191970;">CPI Criteria:</label></td>
                        <td><div class="textbox"><input type="number" placeholder="CPI Criteria" step="0.01" name="cpiCri" maxlength="5"/></div></td>
                    </tr>
                    <tr>
                        <td class="tdLabel"><label for="salpack" class="label" style="font-size:20px; color:#191970;">Salary Package (in LPA):</label></td>
                        <td><div class="textbox"><input type="number" placeholder="Salary Package" name="salpack"/></div></td>
                    </tr>
                    <tr>
                        <td class="tdLabel"><label for="mode" class="label" style="font-size:20px; color:#191970;">Mode of Interview [On/Off Campus]:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="On Campus" name="mode" maxlength="10"/></div></td>
                    </tr>
                    <tr>
                        <td class="tdLabel"><label for="mode1" class="label" style="font-size:20px; color:#191970;">Mode of Interview [Written/Interview]:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="Interview" name="mode1" maxlength="9"/></div></td>
                    </tr>
                    <tr>
                        <td class="tdLabel"><label for="yearrec" class="label" style="font-size:20px; color:#191970;">Year since recruiting from IIT Patna:</label></td>
                        <td><div class="textbox"><input type="number" name="yearrec" placeholder="YYYY" min="2008" max="2023">
                            <script>
                                document.querySelector("input[type=number]")
                                .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
                            </script></div>
                        </td>
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