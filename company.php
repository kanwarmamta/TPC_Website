<!DOCTYPE html>
    <head lang="en">
        <title>Recruiter's Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <h1>Login Page</h1>  
        <form action="company.php" method="get">
            Company ID: <input type="text" name="comId" maxlength="6"/><br>
            Password: <input type="password" name="password" maxlength="20"/><br>
            <input type="submit" name="login" value="Login"/><br>
            <p>Not a member? <a href="com_register.php">Register</a></p>
        </form>
    </body>
</html>

<?php
session_start();
error_reporting(0);
require_once 'dbconfig.php';
$err = "";
$result=true;
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
?>