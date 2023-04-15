<!DOCTYPE html>
<html>
    <head>
        <title>Edit Information</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <h1>Edit Profile</h1>                
        <form action="st_update.php" method="get">
            Roll No: <input type="text" name="stRollno" maxlength="8"/><br>
            Name: <input type="text" name="stName" maxlength="50"/><br>
            Webmail: <input type="text" name="stWebmail" maxlength="100"/><br>
            Phone Number: <input type="text" name="stPhone" maxlength="10"/><br>
            Password: <input type="password" name="stPassword" maxlength="20"/><br>
            10th percentage: <input type="number" step="0.01" name="st10thPer" maxlength="5"/><br>
            12th percentage:<input type="number" step="0.01" name="st12thPer" maxlength="5"/><br>
            Current CPI: <input type="number" step="0.01" name="stcurrCpi" maxlength="5"/><br>
            Age: <input type="number" name="stAge"/><br>
            Specialisation: <input type="text" name="stSpec" maxlength="100"/><br>
            Interest: <input type="text" name="stInterest" maxlength="100"/><br>
            Batch: <input type="number" name="stBatch" placeholder="YYYY" min="2023" max="2026">
                <script>
                    document.querySelector("input[type=number]")
                    .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
                </script><br>
            Placed(Y/N): <input type="text" name="stPlaced" maxlength="1"/><br>
            Package recieved (in LPA): <input type="number" name="stPack"/><br>
            <input type="submit" name="submit" value="Update" />
        </form>
    </body>
</html>

<?php
session_start();
error_reporting(0);
$errors = array();

// Check if the user is logged in
if(!isset($_SESSION["stRollno"]))
{
    header('Location: student.php');
    exit;
}

// Connect to the database
require_once 'dbconfig.php';

// Handle form submission
if(isset($_GET["submit"]))
{
    // Get the user's current information
    $currstRollno= $_SESSION['stRollno'];
    $sql = "SELECT * FROM student WHERE stRollno=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $currstRollno);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    // Get the user's updated information
    $stRollno=$_GET["stRollno"];
    $stName=$_GET["stName"];
    $stWebmail=$_GET["stWebmail"];
    $stPhone=$_GET["stPhone"];
    $stPwd=$_GET["stPassword"];
    $st10thPer=$_GET["st10thPer"];
    $st12thPer=$_GET["st12thPer"];
    $stcurrCpi=$_GET["stcurrCpi"];
    $stAge=$_GET["stAge"];
    $stSpec=$_GET["stSpec"];
    $stInterest=$_GET["stInterest"];
    $stBatch=$_GET["stBatch"];
    $stPlaced=$_GET["stPlaced"];
    $stPack=$_GET["stPack"];
    if(strlen(trim($stPwd))<8)
    {
        echo "Password should be at least 8 characters long.";
        exit;
    }
    // Update the user's information in the "users" table
    $sql = "UPDATE student SET stRollno=?, stName=?, stWebmail=?, stPhone=?, stPassword=?, st10thPer=?, st12thPer=?, stcurrCpi=?, stAge=?, stSpec=?, stInterest=?, stBatch=?, stPlaced=?, stPack=? WHERE stRollno=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssss", $stRollno, $stName, $stWebmail, $stPhone, $stPwd, $st10thPer, $st12thPer, $stcurrCpi, $stAge, $stSpec, $stInterest, $stBatch, $stPlaced, $stPack, $currstRollno);
    $stmt->execute();
    echo "Successfully Updated.";
    exit;
}
?>