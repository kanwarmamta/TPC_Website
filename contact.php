<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<style>
    .card
    {
        position: relative;
        top:100px;
    }
    a,a:hover
    {
        text-decoration: none;
        color: white;
    }
    body
    {
        background: url('reviewback.jpg') no-repeat;
       
        
    }
</style>

<?php
    if(isset($_GET['fullname']))
    {
        $fullname=$_GET["fullname"];
        $email=$_GET["email"];
        $subject=$_GET["subject"];
        $message=$_GET["message"];

        if($fullname=="" || $email=="" || $message=="" ||  $subject=="")
        {
            echo"<center>"; 
            echo "<div class='card text-white mb-3' style='max-width: 18rem; background-color:#191970'><div class='card-header'>Message could not be sent!</div><div class='card-body'><h5 class='card-title'>Some fields are empty!</h5><p class='card-text'>All inputs are required to send suggestions! </p><button class='btn-secondary'><a href='dbwelcome.php'>Go Back!</a></button></div></div>";
            echo "</center>"; 
        }
        else
        {
            if($_SERVER['REQUEST_METHOD']=="GET")//con establish
            {
                require_once 'dbconfig.php';
//Pending.......
		        $sql = "insert into contactTable values('$fullname', '$email', '$message', '$subject')";
                $result = $conn->QUERY($sql);
		        echo"<center>"; 
                echo "<div class='card text-white mb-3' style='max-width: 18rem; background-color:#191970'><div class='card-header'>Message Sent!</div><div class='card-body'><h5 class='card-title'>Thank You, ".$fullname."</h5><p class='card-text'>We appreciate you for taking out your valueable time for us </p><button class='btn-secondary'><a href='dbwelcome.php'>Continue</button></div></div>";
                echo "</center>";
            }
            else
            {
                echo "error";
            }
        }
    }
?>