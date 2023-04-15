<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Alumni Login</title>
        <meta charset="UTF-8">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
	    <link rel="stylesheet" href="Login.css">
    </head>
    <body>
        <form action="alumni.php" method="get">
            <div class="login-box">
			    <h1>Login</h1>

			    <div class="textbox">
				    <i class="fa fa-id-card" aria-hidden="true"></i>
				    <input type="text" placeholder="Roll Number" name="aRollno" value="" maxlength="8">
			    </div>

			    <div class="textbox">
				    <i class="fa fa-lock" aria-hidden="true"></i>
				    <input type="password" placeholder="Password" name="password" value="" maxlength="20">
			    </div>

			    <input class="button" type="submit" name="login" value="Login">
		
                <p>Not a member? <a href="Alu_register.php">Register</a></p>
            </div>
        </form>
    </body>
</html>

<?php
session_start();
error_reporting(0);
require_once 'dbconfig.php';
if(!empty($_GET['status'])){
    echo '<div>You have been logged out!</div>';
}

$err = "";
$result=true;
if (isset($_GET['login'])) {
if ($result)
{
    if(empty(trim($_GET["aRollno"])) || empty(trim($_GET["password"])))
    {
        $err = "Please enter Roll no and password.";
        echo $err;
    }
    else
    {
        $aRollno=$_GET["aRollno"];
        $pwd=$_GET["password"];
        if(empty($err))
        {
            $sql = "SELECT aRollno, aName, aEmail, aPhone, aPassword FROM alumni WHERE aRollno=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $aRollno);
            $param_username=$aRollno;

            if(mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt)==1)
                {
                    mysqli_stmt_bind_result($stmt, $aRollno, $aName, $aEmail, $aPhone, $aPassword);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if($pwd==$aPassword)
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["aRollno"] = $aRollno;
                            $_SESSION["aName"] = $aName;
                            $_SESSION["aEmail"] = $aEmail;
                            $_SESSION["aPhone"] = $aPhone;
                            $_SESSION["loggedin"] = true;
                            //Redirect user to welcome page
                            header("location: Alu_view.php");
                        }
                        else
                        {
                            echo "Password is incorrect.";
                        }
                    } 
                }
            }
        }
        else
        {
            echo "Credentials mismatch.";
        }
    }  
}  
} 
?>