<!DOCTYPE html>
        <head lang="en">
                <title>Register Company</title>
                <meta name="viewport" content="width=device-width, initial-scale=1">
        </head>
        <body>
                <h1>Company Registration Form</h1>                
                <form action="com_register.php" method="get">
                        Company ID: <input type="text" name="comId" maxlength="6"/><br>
                        Company Name: <input type="text" name="comName" maxlength="50"/><br>
                        E-mail: <input type="text" name="comEmail" maxlength="100"/><br>
                        Phone Number: <input type="text" name="comPhone" maxlength="10"/><br>
                        Password: <input type="password" name="comPassword" maxlength="20"/><br>
                        Confirm Password: <input type="password" name="comCpw" maxlength="20"/><br>
                        <input type="submit" name="submit" value="Submit" />
                        <input type="button" value="Login" class="homebutton" id="login" onClick="document.location.href='company.php'" />
                </form>
        </body>     
</html>

<?php
session_start();
error_reporting(0);
require_once 'dbconfig.php';
$comId=$_GET["comId"];
$comName=$_GET["comName"];
$comEmail=$_GET["comEmail"];
$comPhone=$_GET["comPhone"];
$comPwd=$_GET["comPassword"];
$comCpw=$_GET["comCpw"];
$result=true;
$msg="";

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
$conn->close();
?>