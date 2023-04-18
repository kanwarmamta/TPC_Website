<?php
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
        <head>
                <title>Register Company</title>
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
                <form action="com_register.php" method="get">
                        <div class="register-box">
			    <h1>Register</h1>

			    <div class="textbox">
				    <i class="fa fa-id-card" aria-hidden="true"></i>
				    <input type="text" placeholder="Company ID" name="comId" value="" maxlength="6">
			    </div>

                            <div class="textbox">
				    <i class="fa fa-user" aria-hidden="true"></i>
				    <input type="text" placeholder="Company Name" name="comName" value="" maxlength="50">
			    </div>

                            <div class="textbox">
				    <i class="fa fa-envelope" aria-hidden="true"></i>
				    <input type="text" placeholder="E-mail" name="comEmail" value="" maxlength="100">
			    </div>

                            <div class="textbox">
				    <i class="fa fa-phone" aria-hidden="true"></i>
				    <input type="text" placeholder="Phone Number" name="comPhone" value="" maxlength="10">
			    </div>
                        
			    <div class="textbox">
				    <i class="fa fa-lock" aria-hidden="true"></i>
				    <input type="password" placeholder="Password" name="comPassword" value="" maxlength="20">
			    </div>

                            <div class="textbox">
				    <i class="fa fa-lock" aria-hidden="true"></i>
				    <input type="password" placeholder="Confirm Password" name="comCpw" value="" maxlength="20">
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
if (isset($_GET['submit']))
{

require_once 'dbconfig.php';
$comId=$_GET["comId"];
$comName=$_GET["comName"];
$comEmail=$_GET["comEmail"];
$comPhone=$_GET["comPhone"];
$comPwd=$_GET["comPassword"];
$comCpw=$_GET["comCpw"];
$result=true;


$uppercase=preg_match('@[A-Z]@', $comPwd);
$lowercase=preg_match('@[a-z]@', $comPwd);
$number=preg_match('@[0-9]@', $comPwd);
$specialChars=preg_match('@[^\w]@', $comPwd);
$len=strlen(trim($comPwd));

if(!filter_var($comEmail, FILTER_VALIDATE_EMAIL))
{
    $result=false;
    echo '<script>alert("Invalid email format.");</script>';
}

if($result){
    if($comPwd==$comCpw){
        if($uppercase && $lowercase && $number && $specialChars)
        {
                if($len>=8)
                {
                        if (!isset($_GET['decl']) || $_GET['decl'] != 'accepted')
                        {
                                $result = false;
                                echo '<script>alert("You must accept the declaration to edit profile.");</script>';
                        }
                        else
                        {
                                $msg="New record created successfully.";
                                echo '<script>alert("New record created successfully.");</script>';
                                $sql="INSERT INTO company(comId, comName, comEmail, comPhone, comPassword) values('$comId','$comName', '$comEmail', '$comPhone', '$comPwd')";
                                $result=$conn->query($sql);
                                if($msg=="New record created successfully.")
                                {
                                        header("location: company.php");
                                }
                                $result->free();
                        }
                }
                else
                {
                        $result=false;
                        echo '<script>alert("Password should be at least 8 characters long."); </script>';
                }
        }
        else
        {
            $result=false;
            echo '<script>alert("Password must include at least one uppercase alphabet, one lowercase alphabet, one digit and special character."); </script>';
        }
    }
    else
    {
        $result=false;
        echo '<script>alert("Password does not match"); </script>';
    }              
}
}
$conn->close();
?>