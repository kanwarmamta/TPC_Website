<!DOCTYPE html>
<html lang="en">
        <head>
        <title>Student Login</title>
        <meta charset="UTF-8">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
	    <link rel="stylesheet" href="Login.css">
    </head>
    <body>
        <form action="student.php" method="get">
            <div class="login-box">
			    <h1>Login</h1>

			    <div class="textbox">
				    <i class="fa fa-id-card" aria-hidden="true"></i>
				    <input type="text" placeholder="Roll Number" name="stRollno" value="" maxlength="8">
			    </div>

			    <div class="textbox">
				    <i class="fa fa-lock" aria-hidden="true"></i>
				    <input type="password" placeholder="Password" name="stPassword" value="" maxlength="20">
			    </div>

			    <input class="button" type="submit" name="login" value="Login">
		
                <p>Not a member? <a href="st_register.php">Register</a></p>
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
    if(empty(trim($_GET["stRollno"])) || empty(trim($_GET["stPassword"])))
    {
        $err = "Please enter Roll No. and password.";
        echo $err;
    }
    else
    {   
       
        $stRollno=$_GET["stRollno"];
        $pwd=$_GET["stPassword"];
        if(empty($err))
        {
            $sql = "SELECT stRollno, stName, stWebmail, stPhone, stPassword FROM student WHERE stRollno=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $stRollno);
            $param_username=$stRollno;
    
            if(mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt)==1)
                {
                    mysqli_stmt_bind_result($stmt, $stRollno, $stName, $stWebmail, $stPhone, $stPassword);
                    if(mysqli_stmt_fetch($stmt))
                    {
                       
                        if($pwd==$stPassword)
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["stRollno"] = $stRollno;
                            $_SESSION["stName"] = $stName;
                            $_SESSION["stWebmail"] = $stWebmail;
                            $_SESSION["stPhone"] = $stPhone;
                            $_SESSION["loggedin"] = true;
                            //Redirect user to welcome page
                            header("location: st_view.php");
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