<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Recruiter's Login</title>
        <meta charset="UTF-8">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
	    <link rel="stylesheet" href="Login.css">
    </head>
    <body>
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
session_start();
error_reporting(0);
require_once 'dbconfig.php';
$err = "";
$result=true;
if (isset($_GET['login'])) {
if ($result)
{
    if(empty(trim($_GET["comId"])) || empty(trim($_GET["password"])))
    {
        $err = "Please enter company id and password.";
        echo $err;
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