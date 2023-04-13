<!DOCTYPE html>
    <head lang="en">
        <title>Student Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <h1>Student Login Page</h1>  
        <form action="student.php" method="get">
           Roll No: <input type="char" name="stRollno" maxlength="8"/><br>
           <!-- Name: <input type="varchar" name="sName" maxlength="50"/><br>
           Webmail: <input type="varchar" name="sWebmail" maxlength="100"/><br> -->
            Password: <input type="password" name="stPassword" maxlength="20"/><br>
            <input type="submit" name="login" value="Login"/>
            <p>
  		Not a member? <a href="st_register.php">Register</a>
  	</p>
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
?>
