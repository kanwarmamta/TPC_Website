<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="Login.css">
	<link rel="stylesheet" href="navbar.css">
	<title>TPO Login</title>
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
                        <li><a href="Trends.php" class="dropdown" style="color:#f5f5f5;">Placement Statistics</a></li>
                        <li><a href="dbwelcome.php" class="dropdown" style="color:#f5f5f5;">Home</a></li> 
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
	<form action="tpo.php" method="post">
		<div class="login-box">
			<h1>Login</h1>

			<div class="textbox">
				<i class="fa fa-id-card" aria-hidden="true"></i>
				<input type="text" placeholder="Username" name="tpoUsername" value="">
			</div>

			<div class="textbox">
				<i class="fa fa-lock" aria-hidden="true"></i>
				<input type="password" placeholder="Password" name="tpoPwd" value="">
			</div>

			<input class="button" type="submit" name="login" value="Sign In">
		</div>
	</form>
</body>
</html>

<?php
// Connect to the database
require_once 'dbconfig.php';
if(!empty($_GET['status'])){
    echo '<div>You have been logged out!</div>';
}
function test_input($data) {
	
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$tpoUsername = test_input($_POST["tpoUsername"]);
	$tpoPwd = test_input($_POST["tpoPwd"]);
	$stmt = $conn->prepare("SELECT * FROM tpologin");
	$stmt->execute();
	$result = $stmt->get_result();
	$users = $result->fetch_all(MYSQLI_ASSOC);
	
	foreach($users as $user) {
		
		if(($user['tpoUsername'] == $tpoUsername) &&
			($user['tpoPwd'] == $tpoPwd)) {
				header("location: tpoPage.php");
		}
		else {
			echo "<script language='javascript'>";
			echo "alert('WRONG INFORMATION')";
			echo "</script>";
			die();
		}
	}
}
?>