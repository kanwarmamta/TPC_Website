<?php
session_start();
error_reporting(0);
$stRollno=$_SESSION["stRollno"];
$_SESSION["stRollnonew"] = $stRollno;
$stWebmail=$_SESSION["stWebmail"];
$_SESSION["stWebmailnew"] = $stWebmail;
$stName=$_SESSION["stName"];
$_SESSION["stNamenew"]=$stName;
$stPhone=$_SESSION["stPhone"];
$_SESSION["stPhonenew"]=$stPhone;
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: student.php");
}
?>

<!DOCTYPE html>
    <head lang="en">
        <title>Welcome</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <h2>Welcome, <?php echo $_SESSION["stName"]?>! </h2>
        <hr>
        <input type="button" value="Edit Profile" class="homebutton" id="u" onClick="document.location.href='st_update.php'" />
        <input type="button" value="Eligible" class="homebutton" id="k" onClick="document.location.href='st_eligible.php'" />
        <input type="button" value="Delete user" class="homebutton" id="d" onClick="document.location.href='st_delete.php'" />
        <input type="button" value="Logout" class="homebutton" id="l" onClick="document.location.href='st_logout.php'" />
    </body>
</html>