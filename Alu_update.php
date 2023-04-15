<!DOCTYPE html>
<html>
    <head>
        <title>Edit Information</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <h1>Edit Profile</h1>                
        <form action="Alu_update.php" method="get">
            Roll no : <input type="text" name="aRollno" maxlength="8"/><br>
            Name: <input type="text" name="aName" maxlength="50"/><br>
            E-mail: <input type="text" name="aEmail" maxlength="100"/><br>
            Phone Number: <input type="text" name="aPhone" maxlength="10"/><br>
            Password: <input type="password" name="aPassword" maxlength="20"/><br>
            CPI: <input type="number" step="0.01" name="aCpi" maxlength="5"/><br>
            Batch: <input type="number" name="aBatch" placeholder="YYYY" min="2008" max="2022">
                <script>
                    document.querySelector("input[type=number]")
                    .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
                </script><br>
            First Company Joined: <input type="text" name="aCompP" maxlength="50"/><br>
            First CTC: <input type="number" name="aCtcP"/><br>
            Area of interest: <input type="text" name="aAreaIntP" maxlength="100"/><br>
            First Company Role: <input type="text" name="aRoleP" maxlength="100"/><br>
            First Company Location: <input type="text" name="aLocP" maxlength="100"/><br>  
            First Company Tenure: <input type="number" name="aTenureP"/><br>  
            Current Company : <input type="text" name="aCompC" maxlength="50"/><br>
            Current CTC: <input type="number" name="aCtcC"/><br>
            Area of interest: <input type="text" name="aAreaIntC" maxlength="100"/><br>
            Current Company Role: <input type="text" name="aRoleC" maxlength="100"/><br>
            Current Company Location: <input type="text" name="aLocC" maxlength="100"/><br>  
            Current Company  Tenure: <input type="number" name="aTenureC"/><br>

            <div class="checkbox">
				    <label><input type="checkbox" name="decl" value="accepted">I declare that the information given by me is true to my knowledge.</label>
			    </div>

            <input type="submit" name="submit" value="Update" />
        </form>
    </body>
</html>

<?php
session_start();
error_reporting(0);
$errors = array();

// Check if the user is logged in
if(!isset($_SESSION["aRollno"]))
{
    header('Location: alumni.php');
    exit;
}

// Connect to the database
require_once 'dbconfig.php';

// Handle form submission
if(isset($_GET["submit"]))
{
    // Get the user's current information
    $curraRollno= $_SESSION['aRollno'];
    $sql = "SELECT * FROM alumni WHERE aRollno=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $curraRollno);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    // Get the user's updated information
    $aRollno=$_GET["aRollno"];
    $aName=$_GET["aName"];
    $aEmail=$_GET["aEmail"];
    $aPhone=$_GET["aPhone"];
    $aPwd=$_GET["aPassword"];
    $aCpi=$_GET["aCpi"];
    $aBatch=$_GET["aBatch"];
    $aCompP=$_GET["aCompP"];
    $aCtcP=$_GET["aCtcP"];
    $aAreaIntP=$_GET["aAreaIntP"];
    $aRoleP=$_GET["aRoleP"];
    $aLocP=$_GET["aLocP"];
    $aTenureP=$_GET["aTenureP"];
    $aCompC=$_GET["aCompC"];
    $aCtcC=$_GET["aCtcC"];
    $aAreaIntC=$_GET["aAreaIntC"];
    $aRoleC=$_GET["aRoleC"];
    $aLocC=$_GET["aLocC"];
    $aTenureC=$_GET["aTenureC"];

    if(strlen(trim($aPwd))<8)
    {
        echo "Password should be at least 8 characters long.";
        exit;
    }
    
    if (!isset($_GET['decl']) || $_GET['decl'] != 'accepted')
    {
        echo "You must accept the declaration to edit profile.";
    }
    else
    {
        // Update the user's information in the "users" table
        $sql = "UPDATE alumni SET aRollno=?, aName=?, aEmail=?, aPhone=?, aPassword=?, aCpi=?, aBatch=?, aCompP=?, aCtcP=?, aAreaIntP=?, aRoleP=?, aLocP=?, aTenureP=?,aCompC=?, aCtcC=?, aAreaIntC=?, aRoleC=?, aLocC=?, aTenureC=? WHERE aRollno=?";   //left here
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssssssssssss", $aRollno, $aName, $aEmail, $aPhone, $aPwd, $aCpi, $aBatch, $aCompP, $aCtcP, $aAreaIntP, $aRoleP, $aLocP, $aTenureP, $aCompC, $aCtcC, $aAreaIntC, $aRoleC, $aLocC, $aTenureC, $curraRollno);
        $stmt->execute();
        echo "Successfully Updated.";
        exit;
    }
}
?>