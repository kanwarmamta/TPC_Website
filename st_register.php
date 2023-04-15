<!DOCTYPE html>
<html lang="en">
        <head>
                <title>Register Student</title>
                <meta charset="UTF-8">
	        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
	        <link rel="stylesheet" href="Register.css">
        </head>
        <body>               
                <form action="st_register.php" method="get">
                        <div class="register-box">
			    <h1>Register</h1>

			    <div class="textbox">
				    <i class="fa fa-id-card" aria-hidden="true"></i>
				    <input type="text" placeholder="Roll Number" name="stRollno" value="" maxlength="8">
			    </div>

                            <div class="textbox">
				    <i class="fa fa-user" aria-hidden="true"></i>
				    <input type="text" placeholder="Name" name="stName" value="" maxlength="50">
			    </div>

                            <div class="textbox">
				    <i class="fa fa-envelope" aria-hidden="true"></i>
				    <input type="text" placeholder="Webmail" name="stWebmail" value="" maxlength="100">
			    </div>

                            <div class="textbox">
				    <i class="fa fa-phone" aria-hidden="true"></i>
				    <input type="text" placeholder="Phone Number" name="stPhone" value="" maxlength="10">
			    </div>
                        
			    <div class="textbox">
				    <i class="fa fa-lock" aria-hidden="true"></i>
				    <input type="password" placeholder="Password" name="stPassword" value="" maxlength="20">
			    </div>

                            <div class="textbox">
				    <i class="fa fa-lock" aria-hidden="true"></i>
				    <input type="password" placeholder="Confirm Password" name="stCpw" value="" maxlength="20">
			    </div>

			    <input class="button" type="submit" name="submit" value="Submit">
                        </div>
                </form>
        </body>     
</html>

<?php
session_start();
error_reporting(0);
$msg="";
if (isset($_GET['submit']))
{
require_once 'dbconfig.php';
$stRollno=$_GET["stRollno"];
$stName=$_GET["stName"];
$stWebmail=$_GET["stWebmail"];
$stPhone=$_GET["stPhone"];
$stPwd=$_GET["stPassword"];
$stCpw=$_GET["stCpw"];
$result=true;


$uppercase=preg_match('@[A-Z]@', $stPwd);
$lowercase=preg_match('@[a-z]@', $stPwd);
$number=preg_match('@[0-9]@', $stPwd);
$specialChars=preg_match('@[^\w]@', $stPwd);
$len=strlen(trim($stPwd));

if(!filter_var($stWebmail, FILTER_VALIDATE_EMAIL))
{
    $result=false;
    echo "Invalid email format.";
}

if($result){
    if($stPwd==$stCpw){
        if($uppercase && $lowercase && $number && $specialChars)
        {
                if($len>=8)
                {
                        $msg="New record created successfully.";
                        echo $msg;
                        $sql="INSERT INTO student(stRollno, stName, stWebmail, stPhone, stPassword) values('$stRollno','$stName', '$stWebmail', '$stPhone', '$stPwd')";
                        $result=$conn->query($sql);
                        if($msg=="New record created successfully.")
                        {
                            header("location: student.php");
                        }
                        $result->free();
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