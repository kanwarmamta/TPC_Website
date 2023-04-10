<?php

session_start();

error_reporting(0);

$aRollno=$_SESSION["aRollno"];

$_SESSION["aRollno"] = $aRollno;

$aEmail=$_SESSION["aEmail"];

$_SESSION["aEmailnew"] = $aEmail;

$aName=$_SESSION["aName"];

$_SESSION["aNamenew"]=$aName;

$aPhone=$_SESSION["aPhone"];

$_SESSION["aPhonenew"]=$aPhone;

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)

{

    header("location: alumni.php");

}

?>



<!DOCTYPE html>

    <head lang="en">

        <title>Welcome</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>

    <body>

        <h2>Welcome, <?php echo $_SESSION["aName"]?>! </h2>

        <hr>

        <input type="button" value="Update Info" class="homebutton" id="u" onClick="document.location.href='Alu_update.php'" />
        <input type="button" value="Delete user" class="homebutton" id="d" onClick="document.location.href='Alu_delete.php'" />

      <input type="button" value="Logout" class="homebutton" id="l" onClick="document.location.href='Alu_logout.php'" />

</body>

</html>

