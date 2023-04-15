<?php
session_start();
error_reporting(0);

// Check if the user is logged in
if(!isset($_SESSION["stRollno"]))
{
    header('Location: student.php');
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
        $sql = "DELETE FROM student WHERE stRollno = '".$_SESSION['stRollno']."'";
        $result=$conn->query($sql);

        // Destroy the session and redirect to the login page
        session_destroy();
        header('Location: st_register.php');
        exit;
    }
    else if($_GET["confirm"]=="no")
    {
        // Redirect to the profile page
        header('Location: st_view.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Delete Account</title>
        <meta charset="UTF-8">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
	    <link rel="stylesheet" href="Delete.css">
    </head>
    <body>
        <form action="company.php" method="get">
            <div class="delete-box">
                <h1>Delete Account</h1>
                <p style="font-size: 25px;">Do you want to delete your account? </p>
                <label for="confirm-yes" class="container">YES
                    <input type="radio" id="confirm-yes" name="confirm" value="yes">
                    <span class="check"></span>
                </label>
                <label for="confirm-no" class="container">NO
                    <input type="radio" id="confirm-no" name="confirm" value="no" checked>
                    <span class="check"></span>
                </label>
                <input class="button" type="submit" name="confirm" value="Confirm">
            </div>
        </form>
    </body>
</html>