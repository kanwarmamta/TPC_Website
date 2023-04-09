<?php
   require_once 'dbconfig.php';
?>
<!--#5FCF80 is color-->
<!DOCTYPE html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
    .mybutton {
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

.mybutton span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
  top:0;
}

.mybutton span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.mybutton:hover span {
  padding-right: 25px;
}

.mybutton:hover span:after {
  opacity: 1;
  right: 0;
}
</style>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>learntocode.com</title>
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
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        

        <div id ="left">  
            <img src="col_logo.jpg" width="60px" height="60px" id=logo alt="Logo image" style="margin-left: 0px;" />
        </div>
        <a class="navbar-brand" href="dbwelcome.php"><span> Training and Placement Cell, IIT Patna</span></a>
        <!-- <br>
        <a class="navbar-brand" href="dbwelcome.php"><span> प्रशिक्षण एवं स्थानन प्रकोष्ठ</span></a> -->
      </div>
      <div class="collapse navbar-collapse" id="myNavbar" >
        <ul class="nav navbar-nav navbar-right">
            
            <li><a href="student.php">Student</a></li>
            <li><a href="company.php">Company</a></li>
            <li><a href="alumni.php">Alumni</a></li>
            <li><a href="placement.php">Placements</a></li>
            <li><a href="#contactus">Contact Us</a></li>
            <li><a href="#aboutus">About us</a></li>
          
          
          <!-- <li><a href="#" data-target="#login" data-toggle="modal">Log in</a></li>
          <li class="btn-trial"><a href="#" data-target="#signin" data-toggle="modal">Sign in</a></li> -->
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
              <p class="big-text">First you Learn ,then you remove the 'L'</p>
              <p class="small-text">An easy and organized way to explore the world of coding through the window of our website</p>
              <a href="#footer" class="btn get-quote">GIVE A SUGGESTION</a>
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
  
 
  <!--Testimonial-->
  <section id="testimonial" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="header-section text-center">
          <h2 class="white">XXXX?</h2>
          <p class="white">XXX<br> It means a lot to us.</p>
          <hr class="bottom-line bg-white">
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="text-comment">
            <p class="text-par">"Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, nec sagittis sem"</p>
            <p class="text-name">Abraham Doe - Creative Dırector</p>
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="text-comment">
            <p class="text-par">"Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, nec sagittis sem"</p>
            <p class="text-name">Abraham Doe - Creative Dırector</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ Testimonial-->
  <!--Director msg-->
  <section id="director_msg" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="header-section text-center">
          <h2>Director's Message</h2>
          <p>Thousands of coding courses are at your disposal<br>,So what are you waiting for!</p>
          <hr class="bottom-line">
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-6 padleft-right">
          <figure class="imghvr-fold-up">
            <img src="img/course01.jpg" class="img-responsive">
            <figcaption>
              <h3>Course Name</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam atque, nostrum veniam consequatur libero fugiat, similique quis.</p>
            </figcaption>
            <a href="#"></a>
          </figure>
        </div>
        <div class="col-md-4 col-sm-6 padleft-right">
          <figure class="imghvr-fold-up">
            <img src="img/course02.jpg" class="img-responsive">
            <figcaption>
              <h3>Course Name</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam atque, nostrum veniam consequatur libero fugiat, similique quis.</p>
            </figcaption>
            <a href="#"></a>
          </figure>
        </div>
        <div class="col-md-4 col-sm-6 padleft-right">
          <figure class="imghvr-fold-up">
            <img src="img/course03.jpg" class="img-responsive">
            <figcaption>
              <h3>Course Name</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam atque, nostrum veniam consequatur libero fugiat, similique quis.</p>
            </figcaption>
            <a href="#"></a>
          </figure>
        </div>
        <div class="col-md-4 col-sm-6 padleft-right">
          <figure class="imghvr-fold-up">
            <img src="img/course04.jpg" class="img-responsive">
            <figcaption>
              <h3>Course Name</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam atque, nostrum veniam consequatur libero fugiat, similique quis.</p>
            </figcaption>
            <a href="#"></a>
          </figure>
        </div>
        <div class="col-md-4 col-sm-6 padleft-right">
          <figure class="imghvr-fold-up">
            <img src="img/course05.jpg" class="img-responsive">
            <figcaption>
              <h3>Course Name</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam atque, nostrum veniam consequatur libero fugiat, similique quis.</p>
            </figcaption>
            <a href="#"></a>
          </figure>
        </div>
        <div class="col-md-4 col-sm-6 padleft-right">
          <figure class="imghvr-fold-up">
            <img src="img/course06.jpg" class="img-responsive">
            <figcaption>
              <h3>Course Name</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam atque, nostrum veniam consequatur libero fugiat, similique quis.</p>
            </figcaption>
            <a href="#"></a>
          </figure>
        </div>
      </div>
    </div>
  </section>
  <!--/ dir_msg-->
  <!--aboutus-->
  <section id="aboutus" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="header-section text-center">
          <h2>About Us</h2>
          <p>Get professional and complete access to our website<br>,and let the Learning Begin!</p>
          <hr class="bottom-line">
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="price-table">
            <!-- Plan  -->
            <div class="pricing-head">
              <h4>Monthly Plan</h4>
              <span class="fa fa-usd curency"></span> <span class="amount">200</span>
            </div>

            <!-- Plean Detail -->
            <div class="price-in mart-15">
              <a href="#" class="btn btn-bg green btn-block">PURCHACE</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="price-table">
            <!-- Plan  -->
            <div class="pricing-head">
              <h4>Quarterly Plan</h4>
              <span class="fa fa-usd curency"></span> <span class="amount">800</span>
            </div>

            <!-- Plean Detail -->
            <div class="price-in mart-15">
              <a href="#" class="btn btn-bg yellow btn-block">PURCHACE</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="price-table">
            <!-- Plan  -->
            <div class="pricing-head">
              <h4>Year Plan</h4>
              <span class="fa fa-usd curency"></span> <span class="amount">1200</span>
            </div>

            <!-- Plean Detail -->
            <div class="price-in mart-15">
              <a href="#" class="btn btn-bg red btn-block">PURCHACE</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ aboutus-->
  <!--Contact-->
  <section id="contactus" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="header-section text-center">
          <h2>Contact Us</h2>
          <p>All the user visiting the website can contact us any any time by sending their message </p>
               <p>We will do our best to solve your queries</p>
          <hr class="bottom-line">
        </div>
  
        
        <form action="contact.php" method="get"  >
          <div class="col-md-6 col-sm-6 col-xs-12 left">
            <div class="form-group">
              <input type="text" name="fullname" class="form-control form "  placeholder="Your Name"  />
              
            </div>
            <div class="form-group">
              <input type="email" class="form-control" name="email"  placeholder="Your Email"  />
              
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject"  placeholder="Subject"  />
              
            </div>
          </div>

          <div class="col-md-6 col-sm-6 col-xs-12 right">
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5"  placeholder="Message"></textarea>
            
            </div>
          </div>

          <div class="col-xs-12">
           
              <input  type="submit"  class="form contact-form-button light-form-button oswald light" value="Send message">
          </div>
        </form>

          
    




          
          
          
          
          
          
          
          
          
          
          

      </div>
    </div>
  </section>
  <!--/ Contact-->
  <!--Footer-->
  <footer id="footer" class="footer">
    <div class="container text-center">

      <h3>Suggestions Are Welcomed</h3>

      <form class="mc-trial row" action="review.php" method="get">
        <div class="form-group col-md-3 col-md-offset-2 col-sm-4">
          <div class=" controls">
            <input name="username" placeholder="Enter Your FullName" class="form-control" type="text">
          </div>
        </div>
        <!-- End email input -->
        <div class="form-group col-md-3 col-sm-4">
          <div class=" controls">
            <input name="comment" placeholder="Enter Your Suggestion" class="form-control" type="text">
          </div>
        </div>
        <!-- End email input -->
        <div class="col-md-2 col-sm-4">
          <p>
            <button name="submit" type="submit" class="btn btn-block btn-submit">
            Suggest this! <i class="fa fa-arrow-right"></i></button>
          </p>
        </div>
      </form>
      <!-- End newsletter-form -->
      <ul class="social-links">
        <li><a href="#link"><i class="fa fa-twitter fa-fw"></i></a></li>
        <li><a href="#link"><i class="fa fa-facebook fa-fw"></i></a></li>
        <li><a href="#link"><i class="fa fa-google-plus fa-fw"></i></a></li>
        <li><a href="#link"><i class="fa fa-dribbble fa-fw"></i></a></li>
        <li><a href="#link"><i class="fa fa-linkedin fa-fw"></i></a></li>
      </ul>
      ©xxx iitp tpc team21  All rights reserved
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Mentor
        -->
        Designed by <a href="https://amoldalwai.com/">XXX</a>
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
