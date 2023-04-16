<?php
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
        <head>
                <title>Register Alumni</title>
                <meta charset="UTF-8">
	        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
	        <link rel="stylesheet" href="Register.css">
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
                <form action="Alu_register.php" method="get">
                        <div class="register-box">
			    <h1>Register</h1>

			    <div class="textbox">
				    <i class="fa fa-id-card" aria-hidden="true"></i>
				    <input type="text" placeholder="Roll Number" name="aRollno" value="" maxlength="8">
			    </div>

                            <div class="textbox">
				    <i class="fa fa-user" aria-hidden="true"></i>
				    <input type="text" placeholder="Name" name="aName" value="" maxlength="50">
			    </div>

                            <div class="textbox">
				    <i class="fa fa-envelope" aria-hidden="true"></i>
				    <input type="text" placeholder="E-mail" name="aEmail" value="" maxlength="100">
			    </div>

                            <div class="textbox">
				    <i class="fa fa-phone" aria-hidden="true"></i>
				    <input type="text" placeholder="Phone Number" name="aPhone" value="" maxlength="10">
			    </div>
                        
			    <div class="textbox">
				    <i class="fa fa-lock" aria-hidden="true"></i>
				    <input type="password" placeholder="Password" name="aPassword" value="" maxlength="20">
			    </div>

                            <div class="textbox">
				    <i class="fa fa-lock" aria-hidden="true"></i>
				    <input type="password" placeholder="Confirm Password" name="aCpw" value="" maxlength="20">
			    </div>

                            <div class="checkbox">
				    <label><input type="checkbox" name="decl" value="accepted">I declare that the information given by me is true to my knowledge.</label>
			    </div>

			    <input class="button" type="submit" name="submit" value="Submit">
                        </div>
                </form>
        </body>
</html>

<?php
error_reporting(0);
$msg="";

require_once 'dbconfig.php';

$aRollno=$_GET["aRollno"];
$aName=$_GET["aName"];
$aEmail=$_GET["aEmail"];
$aPhone=$_GET["aPhone"];
$aPwd=$_GET["aPassword"];
$aCpw=$_GET["aCpw"];
$result=true;

if (isset($_GET['submit'])) {
$uppercase=preg_match('@[A-Z]@', $aPwd);
$lowercase=preg_match('@[a-z]@', $aPwd);
$number=preg_match('@[0-9]@', $aPwd);
$specialChars=preg_match('@[^\w]@', $aPwd);
$len=strlen(trim($aPwd));

if(!filter_var($aEmail, FILTER_VALIDATE_EMAIL))
{
    $result=false;
    echo "Invalid email format.";
}

if($result){
    if($aPwd==$aCpw){
        if($uppercase && $lowercase && $number && $specialChars)
        {
                if($len>=8)
                {
                        if (!isset($_GET['decl']) || $_GET['decl'] != 'accepted')
                        {
                                $result = false;
                                echo "You must accept the declaration to register.";
                        }
                        else
                        {
                                $msg="New record created successfully.";
                                echo $msg;
                                $sql="INSERT INTO alumni(aRollno, aName, aEmail, aPhone, aPassword) values('$aRollno','$aName', '$aEmail', '$aPhone', '$aPwd')";
                                $result=$conn->query($sql);
                                if($msg=="New record created successfully.")
                                {
                                        header("location: alumni.php");
                                }
                                $result->free();
                        }
                }
                else
                {
                        $result=false;
                        echo "Password must be atleast 8 characters long.";
                }
        }
        else
        {
            $result=false;
            echo "Password must include at least one uppercase alphabet, one lowercase alphabet, one digit and special character.";
        }
    }
    else
    {
        $result=false;
        echo "Passwords don't match.";
    }
}
}
$conn->close();
?>