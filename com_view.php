<?php
session_start();
error_reporting(0);
$comId=$_SESSION["comId"];
$_SESSION["comIdnew"] = $comId;
$comEmail=$_SESSION["comEmail"];
$_SESSION["comEmailnew"] = $comEmail;
$comName=$_SESSION["comName"];
$_SESSION["comNamenew"]=$comName;
$comPhone=$_SESSION["comPhone"];
$_SESSION["comPhonenew"]=$comPhone;
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: company.php");
}
?>

<!DOCTYPE html>
    <head lang="en">
        <title>Welcome</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <h2>Welcome, <?php echo $_SESSION["comName"]?>! </h2>
        <hr>
        <input type="button" value="Update Info" class="homebutton" id="u" onClick="document.location.href='com_update.php'" />
        <input type="button" value="Delete user" class="homebutton" id="d" onClick="document.location.href='com_delete.php'" />
        <input type="button" value="Logout" class="homebutton" id="l" onClick="document.location.href='com_logout.php'" />
    </body>
</html>