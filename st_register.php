<!DOCTYPE html>
        <head lang="en">
                <title>Register Student</title>
                <meta name="viewport" content="width=device-width, initial-scale=1">
        </head>
        <body>
                <h1>Student Registration Form</h1>                
                <form action="st_register.php" method="get">
                        Roll No: <input type="text" name="stRollno" maxlength="8"/><br>
                        Name: <input type="text" name="stName" maxlength="50"/><br>
                        Webmail: <input type="text" name="stWebmail" maxlength="100"/><br>
                        Phone Number: <input type="text" name="stPhone" maxlength="10"/><br>
                        Password: <input type="password" name="stPassword" maxlength="20"/><br>
                        Confirm Password: <input type="password" name="stCpw" maxlength="20"/><br>
                        <input type="submit" name="submit" value="Submit" />
                        <input type="button" value="Login" class="homebutton" id="login" onClick="document.location.href='student.php'" />
                </form>
        </body>     
</html>

<?php
session_start();
// error_reporting(0);
require_once 'dbconfig.php';
$stRollno=$_GET["stRollno"];
$stName=$_GET["stName"];
$stWebmail=$_GET["stWebmail"];
$stPhone=$_GET["stPhone"];
$stPwd=$_GET["stPassword"];
$stCpw=$_GET["stCpw"];
$result=true;
$msg="";

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
$conn->close();
?>