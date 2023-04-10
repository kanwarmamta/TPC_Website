<!DOCTYPE html>

        <head lang="en">

                <title>Almnus Company</title>

                <meta name="viewport" content="width=device-width, initial-scale=1">

        </head>

        <body>

                <h1>Alumni  Registration Form</h1>

                <form action="Alu_register.php" method="get">

                        Roll No: <input type="text" name="aRollno" maxlength="8"/><br>

                        Name: <input type="text" name="aName" maxlength="50"/><br>

                        E-mail: <input type="text" name="aEmail" maxlength="100"/><br>

                        Phone Number: <input type="text" name="aPhone" maxlength="10"/><br>

                        Password: <input type="password" name="aPassword" maxlength="20"/><br>

                        Confirm Password: <input type="password" name="aCpw" maxlength="20"/><br>

                         <input type="submit" name="submit" value="Submit" />

                        <input type="button" value="Login" class="homebutton" id="login" onClick="document.location.href='alumni.php'" />

                </form>

        </body>     

</html>

<?php

session_start();

error_reporting(0);

require_once 'dbconfig.php';

$aRollno=$_GET["aRollno"];

$aName=$_GET["aName"];
$aEmail=$_GET["aEmail"];

$aPhone=$_GET["aPhone"];

$aPwd=$_GET["aPassword"];

$aCpw=$_GET["aCpw"];

$result=true;

$msg="";



$uppercase=preg_match('@[A-Z]@', $aPwd);

$lowercase=preg_match('@[a-z]@', $aPwd);

$number=preg_match('@[0-9]@', $aPwd);

$specialChars=preg_match('@[^\w]@', $aPwd);

$len=strlen(trim($aPwd));



if(!filter_var($aEmail, FILTER_VALIDATE_EMAIL))

{

    $result=false;

    echo "Invalid email format.";

}



if($result){

    if($aPwd==$aCpw){

        if($uppercase && $lowercase && $number && $specialChars)

        {

                if($len>=8)

                {

                        $msg="New record created successfully.";
                        echo $msg;

                        $sql="INSERT INTO alumni(aRollno, aName, aEmail, aPhone, aPassword) values('$aRollno','$aName', '$aEmail', '$aPhone', '$aPwd')";

                        $result=$conn->query($sql);

                        if($msg=="New record created successfully.")

                        {

                            header("location: alumni.php");

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

