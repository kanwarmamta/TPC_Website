<?php
session_start();
error_reporting(0);

// Check if the user is logged in
if(!isset($_SESSION["comId"]))
{
    header('Location: company.php');
    exit;
}

// Connect to the database
require_once 'dbconfig.php';

$result=true;

if ($result)
{
    //Check if the user confirmed the deletion
    if($_GET["confirm"]=="yes")
    {
        // Delete the user's information from the "users" table
        $sql = "DELETE FROM company WHERE comId = '".$_SESSION['comId']."'";
        $result=$conn->query($sql);

        // Destroy the session and redirect to the login page
        session_destroy();
        header('Location: com_register.php');
        exit;
    }
    else if($_GET["confirm"]=="no")
    {
        // Redirect to the profile page
        header('Location: com_view.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Delete Account</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <h1>Delete Account</h1>
        <p>Do you want to delete your account? </p>
        <form method="get">
        <label for="confirm-yes">Yes</label>
        <input type="radio" id="confirm-yes" name="confirm" value="yes"><br>

        <label for="confirm-no">No</label>
        <input type="radio" id="confirm-no" name="confirm" value="no" checked><br>

        <input type="submit" value="Delete">
        </form>
    </body>
</html>