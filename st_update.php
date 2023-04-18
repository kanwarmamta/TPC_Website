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
 // Fetch the user's information from the database
 $currstRollno= $_SESSION['stRollno'];
 $currstName=$_SESSION['stName'];
 $currstWebmail=$_SESSION['stWebmail'];
 $currstPhone=$_SESSION['stPhone'];
 $currstPwd=$_SESSION["stPassword"];
 if (isset($_SESSION["stRollno"])) {
 $sql = "SELECT * FROM student WHERE stRollno=\"{$_SESSION["stRollno"]}\"";
 $result = $conn->query($sql); 
 $user = $result->fetch_assoc();
}else{
    die("please login");

    exit;
}
   
      

// while ($row = mysqli_fetch_assoc($result)) {
           
 
//  $currst10thPer=$row['st10thPer'];
//  $currst12thPer=$row["st12thPer"];
//  $currstcurrCpi=$row["stcurrCpi"];
//  $currstAge=$row["stAge"];
//  $currstSpec=$row["stSpec"];
//  $currstInterest=$row["stInterest"];
//  $currstBatch=$row["stBatch"];
//  $currstPlaced=$row["stPlaced"];
//  $currstPack=$row["stPack"];
//  $currstRollno = $row['stRollno'];
          

//         } 
 
//     }


echo $currstRollno;
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
    $stTranscript=$_GET["stTranscript"];
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

    if (!isset($_GET['decl']) || $_GET['decl'] != 'accepted')
    {
        echo "You must accept the declaration to edit profile.";
    }
    else
    {
        // Update the user's information in the "users" table
        $sql = "UPDATE student SET stRollno=?, stName=?, stWebmail=?, stPhone=?, stPassword=?, st10thPer=?, st12thPer=?, stcurrCpi=?, stTranscript=?, stAge=?, stSpec=?, stInterest=?, stBatch=?, stPlaced=?, stPack=? WHERE stRollno=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssssssss", $stRollno, $stName, $stWebmail, $stPhone, $stPwd, $st10thPer, $st12thPer, $stcurrCpi, $stTranscript, $stAge, $stSpec, $stInterest, $stBatch, $stPlaced, $stPack, $currstRollno);
        $stmt->execute();
        echo "Successfully Updated.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Information</title>
        <meta charset="UTF-8">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
	    <link rel="stylesheet" href="Update.css">
        <link rel="stylesheet" href="navbar.css">
    </head>
    <body>
        <!--Navigation bar-->
        <nav class="navbar navbar-default navbar-fixed-top" style="background-color:#191970;">
            <div class="container">
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
        
                    <div class="col-md-3 col-sm-6 col-xs-12 left" id ="left">  
                        <img src="col_logo.png" width="100px" height="100px" id=logo alt="Logo image" style="margin-left: 0px;" />
                    </div>
                    <a class="navbar-brand" href="dbwelcome.php" style="color:white;font-size:155%;"><span> Training and Placement Cell, IIT Patna</span></a>
                    <br>
                    <a class="navbar-brand" href="dbwelcome.php" style="color:white;font-size:155%;font-family:KrutiDev;"><span> प्रशिक्षण एवं स्थानन प्रकोष्ठ</span></a>
                    <!-- <a class="navbar-brand" href="dbwelcome.php" style="color:white;font-size:155%;font-family:KrutiDev;"><span> प्रशिक्षण एवं स्थानन प्रकोष्ठ, आईआईटी पटना</span></a> -->
                </div>
                <div class="collapse navbar-collapse" id="myNavbar" >
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="Trends.php" class="dropbtn" style="color:#f5f5f5;">Placement Statistics</a></li>
                        <li><div class="dropdown">
                            <a href="#" class="dropbtn" style="color:#f5f5f5;">Login</a>
                            <div class="dropdown-content">
                                <a href="student.php">Student</a>
                                <a href="company.php">Company</a>
                                <a href="alumni.php">Alumni</a>
                                <a href="admin.php">Admin</a>
                                <a href="tpo.php">TPO</a>
                            </div>
                        </div></li>   
                    </ul>
                </div>
            </div>
        </nav>
        <!--/ Navigation bar-->

        <!-- Banner-->
        <div class="banner">
            <div class="bg-color">
                <div class="container">
                    <div class="row">
                        <div class="banner-text text-center">
                            <div class="text-border">
                                <h2 class="text-dec">Learn To Code</h2>
                            </div>
                            <div class="intro-para text-center quote">
                                <p><br><br></p>
                            </div>
                            <a href="#feature" class="mouse-hover">
                                <div class="mouse"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Banner-->

        <form action="st_update.php" method="get">
            <div class="update-box">
			    <h1>Edit Profile</h1>
                <table>
                    <tr>
                        <td class="tdLabel"><label for="stRollno" class="label" style="font-size:20px; color:#191970;">Roll Number:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="Roll Number" name="stRollno" value="<?php echo $currstRollno;?>" maxlength="8"></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="stName" class="label" style="font-size:20px; color:#191970;">Name:</label></td>
                        <td><div class="textbox"><input type="text"  name="stName" value="<?php echo $currstName;?>" maxlength="50"></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="stWebmail" class="label" style="font-size:20px; color:#191970;">Webmail:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="Webmail" name="stWebmail" value="<?php echo $currstWebmail;?>" maxlength="100"></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="stPhone" class="label" style="font-size:20px; color:#191970;">Phone Number:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="Phone Number" name="stPhone" value="<?php echo $currstPhone;?>" maxlength="10"></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="stPassword" class="label" style="font-size:20px; color:#191970;">Password:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="Password" name="stPassword" value=<?= htmlspecialchars($user["stPassword"]) ?> maxlength="20"></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="st10thPer" class="label" style="font-size:20px; color:#191970;">10th percentage:</label></td>
                        <td><div class="textbox"><input type="number" placeholder="10th percentage" name="st10thPer" value=<?= htmlspecialchars($user["st10thPer"]) ?> step="0.01" maxlength="5"></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="st12thPer" class="label" style="font-size:20px; color:#191970;">12th percentage:</label></td>
                        <td><div class="textbox"><input type="number" placeholder="12th percentage" name="st12thPer" value=<?= htmlspecialchars($user["st12thPer"]) ?> step="0.01" maxlength="5"></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="stcurrCpi" class="label" style="font-size:20px; color:#191970;">Current CPI:</label></td>
                        <td><div class="textbox"><input type="number" placeholder="Current CPI" name="stcurrCpi" value=<?= htmlspecialchars($user["stcurrCpi"])?> step="0.01" maxlength="5"></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="stTranscript" class="label" style="font-size:20px; color:#191970;">Transcript Link:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="Transcript Link" name="stTranscript" value=<?= htmlspecialchars($user["stTranscript"]) ?> ></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="stAge" class="label" style="font-size:20px; color:#191970;">Age:</label></td>
                        <td><div class="textbox"><input type="number" placeholder="Age" name="stAge" value=<?= htmlspecialchars($user["stAge"]) ?> ></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="stSpec" class="label" style="font-size:20px; color:#191970;">Specialisation:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="Specialisation" name="stSpec" value=<?= htmlspecialchars($user["stSpec"]) ?> maxlength="100"/></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="stInterest" class="label" style="font-size:20px; color:#191970;">Interest:</label></td>
                        <td><div class="textbox"><input type="text" placeholder="stInterest" name="stInterest" value=<?= htmlspecialchars($user["stInterest"]) ?> maxlength="50"/></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="stBatch" class="label" style="font-size:20px; color:#191970;">Batch:</label></td>
                        <td><div class="textbox"><input type="number" placeholder="YYYY" name="stBatch" value=<?= htmlspecialchars($user["stBatch"]) ?> min="2023" max="2026">
                            <script>
                                document.querySelector("input[type=number]")
                                .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
                            </script>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="stPlaced" class="label" style="font-size:20px; color:#191970;">Placed(Y/N):</label></td>
                        <td><div class="textbox"><input type="text" placeholder="Y/N" name="stPlaced" value=<?= htmlspecialchars($user["stPlaced"]) ?> maxlength="1"/></div></td>
                    </tr>

                    <tr>
                        <td class="tdLabel"><label for="stPack" class="label" style="font-size:20px; color:#191970;">Package recieved (in LPA):</label></td>
                        <td><div class="textbox"><input type="number" name="stPack" value=<?= htmlspecialchars($user["stPack"]) ?> placeholder="Package recieved (in LPA):"></td>
                    </tr>

                </table>
                <div class="checkbox">
				    <label><input type="checkbox" name="decl" value="accepted"><b>I declare that the information given by me is true to my knowledge.</b></label>
			    </div>

			    <input class="button" type="submit" name="submit" value="Update">
		
            </div>
        </form>
    </body>
</html>