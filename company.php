<?php
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Recruiter's Login</title>
        <meta charset="UTF-8">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
	    <link rel="stylesheet" href="Login.css">
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
        <form action="company.php" method="get">
            <div class="login-box">
			    <h1>Login</h1>

			    <div class="textbox">
				    <i class="fa fa-id-card" aria-hidden="true"></i>
				    <input type="text" placeholder="Company ID" name="comId" value="" maxlength="6">
			    </div>

			    <div class="textbox">
				    <i class="fa fa-lock" aria-hidden="true"></i>
				    <input type="password" placeholder="Password" name="password" value="" maxlength="20">
			    </div>

			    <input class="button" type="submit" name="login" value="Login">
		
                <p>Not a member? <a href="com_register.php">Register</a></p>
            </div>
        </form>
    </body>
</html>

<?php
error_reporting(0);
require_once 'dbconfig.php';
if(!empty($_GET['status'])){
    echo '<script>alert("You have been logged out"); </script>';
}

$err = "";
$result=true;
if (isset($_GET['login'])) {
if ($result)
{
    if(empty(trim($_GET["comId"])) || empty(trim($_GET["password"])))
    {
        $err = "Please enter company id and password.";
        //echo $err;
        echo '<script>alert("Please enter company id and password."); </script>';
    }
    else
    {
        $comId=$_GET["comId"];
        $pwd=$_GET["password"];
        if(empty($err))
        {
            $sql = "SELECT comId, comName, comEmail, comPhone, comPassword FROM company WHERE comId=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $comId);
            $param_username=$comId;
    
            if(mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt)==1)
                {
                    mysqli_stmt_bind_result($stmt, $comId, $comName, $comEmail, $comPhone, $comPassword);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if($pwd==$comPassword)
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["comId"] = $comId;
                            $_SESSION["comName"] = $comName;
                            $_SESSION["comEmail"] = $comEmail;
                            $_SESSION["comPhone"] = $comPhone;
                            $_SESSION["loggedin"] = true;
                            //Redirect user to welcome page
                            header("location: com_view.php");
                        }
                        else
                        {
                            echo '<script>alert("Password is incorrect."); </script>';
                        }
                    } 
                }
            }
        }
        else
        {
            echo '<script>alert("Credentials mismatch."); </script>';
        }
    }  
} 
}  
?>
