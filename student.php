<!DOCTYPE html>
    <head lang="en">
        <title>Student_Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <h1>Student Login Page</h1>  
        <form action="student.php" method="get">
           Roll No: <input type="char" name="sRollNo" maxlength="8"/><br>
           <!-- Name: <input type="varchar" name="sName" maxlength="50"/><br>
           Webmail: <input type="varchar" name="sWebmail" maxlength="100"/><br> -->
            Password: <input type="password" name="stPassword" maxlength="20"/><br>
            <input type="submit" name="st_login" value="Login"/>
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
    if(empty(trim($_GET["stRollno"])) || empty(trim($_GET["stPassword"])))
    {
        $err = "Please enter Roll No. and password.";
        echo $err;
    }
    else
    {
        $RollNo=$_GET["stRollno"];
        $pwd=$_GET["stPassword"];
        if(empty($err))
        {
            $sql = "SELECT stRollno, stName, stWebmail, stPhone, password FROM student WHERE stRollno=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $RollNo);
            $param_username=$RollNo;
    
            if(mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt)==1)
                {
                    mysqli_stmt_bind_result($stmt, $stRollno, $stName, $stWebmail, $stPhone, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if($pwd==$hashed_password)
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["stRollno"] = $RollNo;
                            $_SESSION["stName"] = $Name;
                            $_SESSION["stWebmail"] = $Webmail;
                            $_SESSION["stPhone"] = $Phone;
                            $_SESSION["loggedin"] = true;
                            //Redirect user to welcome page
                            header("location: dbwelcome.php");
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
