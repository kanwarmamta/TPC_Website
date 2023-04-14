<!DOCTYPE html>

    <head lang="en">

        <title>Alumni Login</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>

    <body>

        <h1>Login Page</h1>  

        <form action="alumni.php" method="get">

            Roll no: <input type="text" name="aRollno" maxlength="8"/><br>

            Password: <input type="password" name="password" maxlength="20"/><br>

            <input type="submit" name="login" value="Login"/><br>

            <p>Not a member? <a href="Alu_register.php">Register</a></p>

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

    if(empty(trim($_GET["aRollno"])) || empty(trim($_GET["password"])))

    {
        $err = "Please enter Roll no  and password.";

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

?>
