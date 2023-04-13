<!DOCTYPE html>
<html>
    <head>
        <title>Edit Information</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <h1>Edit Profile</h1>                
        <form action="com_update.php" method="get">
            Company ID: <input type="text" name="comId" maxlength="6"/><br>
            Company Name: <input type="text" name="comName" maxlength="50"/><br>
            E-mail: <input type="text" name="comEmail" maxlength="100"/><br>
            Phone Number: <input type="text" name="comPhone" maxlength="10"/><br>
            Password: <input type="password" name="comPassword" maxlength="20"/><br>
            Required Candidates: <input type="number" name="reqCandi"/><br>
            Minimum Qualification: <input type="number" name="minQual" placeholder="YYYY" min="2023" max="2026">
                <script>
                    document.querySelector("input[type=number]")
                    .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
                </script><br>
            Standard 10th Marks Criteria: <input type="number" step="0.01" name="10thCri" maxlength="5"/><br>
            Standard 12th Marks Criteria: <input type="number" step="0.01" name="12thCri" maxlength="5"/><br>
            CPI Criteria: <input type="number" step="0.01" name="cpiCri" maxlength="5"/><br>
            Salary Package: <input type="number" name="salpack"/><br>
            Mode of Interview [Online/Offline]: <input type="text" name="mode" maxlength="7"/><br>
            Mode of Interview [Written/Interview]: <input type="text" name="mode1" maxlength="9"/><br>
            Year since recruiting from IIT Patna: <input type="number" name="yearrec" placeholder="YYYY" min="2008" max="2023">
                <script>
                    document.querySelector("input[type=number]")
                    .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
                </script><br>
            <input type="submit" name="submit" value="Update" />
        </form>
    </body>
</html>

<?php
session_start();
error_reporting(0);
$errors = array();

// Check if the user is logged in
if(!isset($_SESSION["comId"]))
{
    header('Location: company.php');
    exit;
}

// Connect to the database
require_once 'dbconfig.php';

// Handle form submission
if(isset($_GET["submit"]))
{
    // Get the user's current information
    $currcomId= $_SESSION['comId'];
    $sql = "SELECT * FROM company WHERE comId=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $currcomId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    // Get the user's updated information
    $comId=$_GET["comId"];
    $comName=$_GET["comName"];
    $comEmail=$_GET["comEmail"];
    $comPhone=$_GET["comPhone"];
    $comPwd=$_GET["comPassword"];
    $reqCandi=$_GET["reqCandi"];
    $minQual=$_GET["minQual"];
    $Cri10=$_GET["10thCri"];
    $Cri12=$_GET["12thCri"];
    $cpiCri=$_GET["cpiCri"];
    $salpack=$_GET["salpack"];
    $mode=$_GET["mode"];
    $mode1=$_GET["mode1"];
    $yearrec=$_GET["yearrec"];

    if(strlen(trim($comPwd))<8)
    {
        echo "Password should be at least 8 characters long.";
        exit;
    }
    
    // Update the user's information in the "users" table
    $sql = "UPDATE company SET comId=?, comName=?, comEmail=?, comPhone=?, comPassword=?, reqCandi=?, minQual=?, 10thCri=?, 12thCri=?, cpiCri=?, salpack=?, mode=?, mode1=?, yearrec=? WHERE comId=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssss", $comId, $comName, $comEmail, $comPhone, $comPwd, $reqCandi, $minQual, $Cri10, $Cri12, $cpiCri, $salpack, $mode, $mode1, $yearrec, $currcomId);
    $stmt->execute();
    echo "Successfully Updated.";
    exit;
}
?>
