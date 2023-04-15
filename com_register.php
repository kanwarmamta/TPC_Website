<!DOCTYPE html>
<html lang="en">
        <head>
                <title>Register Company</title>
                <meta charset="UTF-8">
	        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
	        <link rel="stylesheet" href="Register.css">
        </head>
        <body>              
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
				    <input type="password" placeholder="Password" name="password" value="" maxlength="20">
			    </div>

                            <div class="textbox">
				    <i class="fa fa-lock" aria-hidden="true"></i>
				    <input type="password" placeholder="Confirm Password" name="comCpw" value="" maxlength="20">
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
    echo "Invalid email format.";
}

if($result){
    if($comPwd==$comCpw){
        if($uppercase && $lowercase && $number && $specialChars)
        {
                if($len>=8)
                {
                        $msg="New record created successfully.";
                        echo $msg;
                        $sql="INSERT INTO company(comId, comName, comEmail, comPhone, comPassword) values('$comId','$comName', '$comEmail', '$comPhone', '$comPwd')";
                        $result=$conn->query($sql);
                        if($msg=="New record created successfully.")
                        {
                            header("location: company.php");
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