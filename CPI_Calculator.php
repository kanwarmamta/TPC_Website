<!DOCTYPE html>
<html>
<head>
	<title>CPI Calculator</title>
	<style>
		body {
	margin: 0;
	padding: 0;
	font-family: sans-serif;
	background: url() no-repeat;
	background-size: cover;
}
.box {
	width: 500px;
	margin-top: 220px;
	position: relative;
	max-height: 500px;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	color: #191970;
}
.box h1 {
	float: left;
	font-size: 40px;
	align: center;
	border-bottom: 4px solid #191970;
	margin-bottom: 20px;
	padding: 13px;
	color: #191970;
}
.box p {
			text-align: center;
			font-size: 24px;
			font-weight: bold;
			margin-top: 20px;
			margin-bottom: 0px;
		}

.textbox {
	width: 90%;
	font-size: 20px;
	padding: 8px 0;
	margin: 8px 0;
}

.textbox input {
	border: none;
	outline: none;
	background: none;
	font-size: 18px;
	float: left;
	margin: 0 10px;
}

.button {
	width: 100%;
	padding: 8px;
	color: #ffffff;
	background: none #191970;
	border: none;
	border-radius: 6px;
	font-size: 18px;
	cursor: pointer;
	margin: 12px 0;
}
p {
			text-align: center;
			font-size: 24px;
			font-weight: bold;
			margin-top: 800px;
		}
		form {
			margin: 20px auto;
			max-width: 500px;
			padding: 20px;
			border: 1px solid #ccc;
			border-radius: 10px;
		}
		input[type="number"] {
			display: block;
			margin-bottom: 10px;
			width: 100%;
			padding: 10px;
			font-size: 16px;
			border-radius: 5px;
			border: 1px solid #ccc;
		}
	</style>
</head>
<body>
	<div class="box">
	<h1>CPI Calculator<br></h1>
	<form method="post">
		<p><br><br><br></p>
		<p>Semester 1<br></p>
		<div class="textbox">
		<input type="number" step="0.01" placeholder="SPI" id="spi1" name="spi1">
			    </div>
				<div class="textbox">
		<input type="number" placeholder="Credits" id="crd1" name="crd1">
			    </div>
				<p>Semester 2<br></p>
		<div class="textbox">
		<input type="number" step="0.01" placeholder="SPI" id="spi2" name="spi2">
			    </div>
				<div class="textbox">
		<input type="number" placeholder="Credits" id="crd2" name="crd2">
			    </div>
				<p>Semester 3<br></p>
		<div class="textbox">
		<input type="number" step="0.01" placeholder="SPI" id="spi3" name="spi3">
			    </div>
				<div class="textbox">
		<input type="number" placeholder="Credits" id="crd3" name="crd3">
			    </div>
				<p>Semester 4<br></p>
		<div class="textbox">
		<input type="number" step="0.01" placeholder="SPI" id="spi4" name="spi4">
			    </div>
				<div class="textbox">
		<input type="number" placeholder="Credits" id="crd4" name="crd4">
			    </div>
				<p>Semester 5<br></p>
		<div class="textbox">
		<input type="number" step="0.01" placeholder="SPI" id="spi5" name="spi5">
			    </div>
				<div class="textbox">
		<input type="number" placeholder="Credits" id="crd5" name="crd5">
			    </div>
				<p>Semester 6<br></p>
		<div class="textbox">
		<input type="number" step="0.01" placeholder="SPI" id="spi6" name="spi6">
			    </div>
				<div class="textbox">
		<input type="number" placeholder="Credits" id="crd6" name="crd6">
			    </div>
				<p>Semester 7<br></p>
		<div class="textbox">
		<input type="number" step="0.01" placeholder="SPI" id="spi7" name="spi7">
			    </div>
				<div class="textbox">
		<input type="number" placeholder="Credits" id="crd7" name="crd7">
			    </div>
				<p>Semester 8<br></p>
		<div class="textbox">
		<input type="number" step="0.01" placeholder="SPI" id="spi8" name="spi8">
			    </div>
				<div class="textbox">
		<input type="number" placeholder="Credits" id="crd8" name="crd8">
			    </div>
		<input class="button" type="submit" value="Calculate CPI">
	</div>
	</form>

	<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$spi1 = $_POST["spi1"];
			$spi2 = $_POST["spi2"];
			$spi3 = $_POST["spi3"];
			$spi4 = $_POST["spi4"];
			$spi5 = $_POST["spi5"];
			$spi6 = $_POST["spi6"];
			$spi7 = $_POST["spi7"];
			$spi8 = $_POST["spi8"];
			$crd1 = $_POST["crd1"];
			$crd2 = $_POST["crd2"];
			$crd3 = $_POST["crd3"];
			$crd4 = $_POST["crd4"];
			$crd5 = $_POST["crd5"];
			$crd6 = $_POST["crd6"];
			$crd7 = $_POST["crd7"];
			$crd8 = $_POST["crd8"];

            // Calculate the CPI
            $cpi = ($spi1*$crd1 + $spi2*$crd2 + $spi3*$crd3 + $spi4*$crd4 + $spi5*$crd5 + $spi6*$crd6 + $spi7*$crd7 + $spi8*$crd8) / ($crd1 +$crd2 +$crd3 +$crd4 +$crd5 +$crd6 +$crd7 +$crd8  );
    
            // Display the CPI
            echo "<p>Your CPI is: " . number_format((float)$cpi, 2, '.', '') . "</p>";
        }
    ?> 
    </body>
    </html>