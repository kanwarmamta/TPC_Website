<?php
   require_once 'dbconfig.php';
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
  .mouse
  {
    transform: rotate(90deg);
    background-color: black;
  }
  .price-table:hover
  {
    box-shadow: 5px 5px 5px lightgrey, -5px 0px 5px lightgrey;
  }
 .modal-header
  {
    background-color:#5FCF80;   
  }
  .mybutton
  {
    border-radius: 0px 40px 40px 0px;
    background-color: #5FCF80;
    border: none;
    color: #FFFFFF;
    text-align: center;
    font-size: 28px;
    padding: 10px;
    width: 200px;
    transition: all 0.5s;
    cursor: pointer;
    margin: 5px;
  }
  .mybutton span
  {
    cursor: pointer;
    display: inline-block;
    position: relative;
    transition: 0.5s;
    top:0;
  }
  .mybutton span:after
  {
    content: '\00bb';
    position: absolute;
    opacity: 0;
    top: 0;
    right: -20px;
    transition: 0.5s;
  }
  .mybutton:hover span
  {
    padding-right: 25px;
  }
  .mybutton:hover span:after
  {
    opacity: 1;
    right: 0;
  }
  .dropdown
  {
    position:relative;
    display: inline-block;
    margin-top:16px;
    margin-right:5px;
    margin-left:5px;
  }
  .dropbtn
  {
    color: #f5f5f5;
    background-color: transparent;
    width: 200px;
    margin-left: 10px;
    margin-right: 10px;
    border: none;
    cursor: pointer;
    font-size: 14px;
  }
.dropdown-content
{
  display: none;
  position: absolute;
  z-index: 1;
  background-color: #f5f5f5;
  min-width: 100px;
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}
.dropdown-content a
{
  color: #333;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}
.dropdown:hover .dropdown-content
{
  display: block;
}
.textbox
{
	width: 100%;
	overflow: hidden;
	font-size: 20px;
	padding: 8px 0;
	margin: 8px 0;
	border-bottom: 1px solid #191970;
}
.textbox input
{
	width: 100%;
  border: none;
	outline: none;
	background: none;
	font-size: 18px;
	float: left;
	margin: 0;
}
.fa
{
	width: px;
	float: left;
	text-align: center;
}
.button
{
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
</style>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Training and Placement Cell, IIT Patna</title>
  <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
  <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Candal|Alegreya+Sans">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/imagehover.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
 
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
            <li>
              <div class="dropdown">
                <a href="#" class="dropbtn" style="color:#f5f5f5;">Login</a>
                <div class="dropdown-content">
                <a href="student.php">Student</a>
                <a href="company.php">Company</a>
                <a href="alumni.php">Alumni</a>
                <a href="admin.php">Admin</a>
                <a href="tpo.php">TPO</a>
                </div>
              </div>
            </li>
            
        </ul>
      </div>
    </div>
  </nav>
  <!--/ Navigation bar-->

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

  <!--aboutus-->
  <section id="aboutus" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="header-section text-left">
          <h2 style="color:#191970;">About Us</h2>
          <hr class="bottom-line">
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-6 padleft-right text-justify">
              <p>The Indian Institute of Technology Patna epitomizes and reveres this limitless power in every way of its life and functioning. Established as an institute of national importance through an act of parliament in 2008, IIT Patna strives to provide world class education and an intellectually stimulating environment in an endeavor to develop well rounded individuals with technical and professional competence of the highest degree.</p>
              <p>The Training and Placement Cell of the institute handles all aspects of placements at IIT Patna for the graduating students of all departments. Right from contacting companies to managing all logistics of arranging for tests, pre-placement talks and conducting final interviews the Training and Placement Cell officials and volunteers provide their best possible assistance to the recruiters.</p>
        </div>
      </div>
    </div>
  </section>
  <!--/ aboutus-->

  <!--Director msg-->
  <section id="director_msg" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="header-section text-left">
          <h2 style="color:#191970;">Director's Message</h2>
          <hr class="bottom-line">
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-9 col-sm-6 padleft-right text-justify">
              <p>The Indian Institute of Technology Patna is one of the new IITs established by an Act of the Indian Parliament on August 6, 2008 and is recognized as an Institute of National Importance by the Government of India. Currently, IIT Patna has ten departments which offer B.Tech., M.Tech., M.Sc., and Ph.D. programs. Since its inception, IIT Patna has pursued excellence with steadfast determination. The Institute has developed modern facilities that are fully equipped with state-of-the-art facilities that are routinely used to train and educate students. Also, we keep our curriculum updated and provide ample extra-curricular opportunities for the students. As a result, our students excel both in knowledge and leadership skills.</p>
              <p>Patna has been a center of knowledge and a land of visionaries since long and has been attracting visitors and scholars from many parts of the world. Some of the legends from this region include Lord Gautam Buddha, Lord Mahavir, Guru Gobind Singh, the famous astronomer Aryabhatta, and the first President of India, Dr. Rajendra Prasad. IIT Patna strives to carry the baton passed through these visionaries to become a beacon of knowledge and wisdom.</p>
              <p>IIT Patna invites the recruiters to the Campus Recruitment Program for 2022-23 Batch, to give this batch of graduating students an opportunity to prove themselves and to add value to the organizations they join. We assure you that this will be a positive experience for the recruiters and a step forward in improving upon past relations and building new ones.</p>
              <p>I welcome you to become a part of our story and to form a long-lasting association with the institute.</p>
              <p>Prof. T.N. Singh,<br>Director, Indian Institute of Technology Patna</p>
        </div>
        <div class="col-md-3 col-sm-6 padleft-left">
            <img src="dir.jpg" width="300px" height="350px" id=logo alt="Dir image" style="margin-left: 0px;" />
        </div>
      </div>
    </div>
  </section>
  <!--/ dir_msg-->

  <!--Contact-->
  <section id="contactus" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="header-section text-left">
          <h2 style="color:#191970;">Contact Us</h2>
          <hr class="bottom-line">
        </div>
  
        <form action="contact.php" method="get"  >
          <div class="col-md-6 col-sm-6 col-xs-12 left">
            <div class="textbox">
              <input type="text" name="fullname" placeholder="Your Name"  value=""/>
            </div>

            <div class="textbox">
              <input type="email" name="email" placeholder="Your Email" value=""/>
            </div>

            <div class="textbox">
              <input type="text" name="subject"  placeholder="Subject" value=""/>
            </div>

            <div>
              <input  class="button" type="submit" name="sendmessage" value="Send message">
              <hr class="bottom-line">
            </div>
          </div>

          <div class="col-md-6 col-sm-6 col-xs-12 right">
            <div class="textbox">
              <textarea name="message" rows="6" cols="53" placeholder=" Message" value="" maxlength="350"></textarea>
            </div>
          </div>

          <div class="col-xs-12">
              <div class="col-md-6 col-sm-6 col-xs-12 left">
                <p>Interested companies can directly contact through<br>Email: tpc@iitp.ac.in & pic_tnp@iitp.ac.in<br>Please feel free to contact us at +91-6115-233 091/083 and +91-8102917501</p>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12 left">
                <p>Address:<br>Training and Placement Cell, IIT Patna, Bihta Campus,<br>Bihta Kanpa Road, Bihta, Bihar Pin - 801106, India.</p>
              </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <!--/ Contact-->
  <!--Footer-->
  <footer id="footer" class="footer" style="background-color:#191970;">
  <p><br></p>
    <div class="container text-center">
        <button><a href="https://www.facebook.com/iitpatna.tpc" style="color:#191970"><i class="fa fa-facebook" ></i></a></button>
        <button><a href="https://www.linkedin.com/in/tpciitpatna" style="color:#191970"><i class="fa fa-linkedin"></i></a></button>
      <p style="color:#f5f5f5;">©TPC, IITP  All rights reserved</p>
      <div class="credits" style="color:#f5f5f5;">
        Designed by Amisha, Mamta, Nishita
      </div>
    </div>
  </footer>
  <!--/ Footer-->

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.easing.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="contactform/contactform.js"></script>

</body>
</html>