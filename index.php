 <?php  include('hh.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ระบบจองหนังสือห้องสำนักวิทยบริการและเทคโนโลยีสารสนเทศ</title>
    <style type="text/css">
    body,td,th {
	font-family: Lato, "Helvetica Neue", Helvetica, Arial, sans-serif;
}
body {
	background-image: url(img/huayi.jpg_640x640.jpg);
}
    </style>
    <?php include('css.php');?>

  </head>
  <body>
      <div class="slideshow-container">
        <div class="mySlides fade">
          <div class="numbertext">1 / 3</div>
          <img src="img/dev.jpg" style="width:100%">
          <div class="text">Caption Text</div>
        </div>

        <div class="mySlides fade">
          <div class="numbertext">2 / 3</div>
          <img src="img/banner.jpg" style="width:100%">
          <div class="text">Caption Two</div>
        </div>

        <div class="mySlides fade">
          <div class="numbertext">3 / 3</div>
          <img src="img/ems.png" style="width:100%">
          <div class="text">Caption Three</div>
        </div>
   

        </div>
        <br>

        <div style="text-align:center">
          <span class="dot"></span> 
          <span class="dot"></span> 
          <span class="dot"></span> 
        </div>

    <?php  include('menu.php');?>
    <div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
          
          <?php //include("slides.php");?>
          
          </div> <!-- close col-->
          </div> <!-- close row-->
          </div>    <!-- close container-->
          <!--Start Menugroup-->
          <div class="container">
            <div class="row">
              <div class="col-md-2">
                <br>
                <?php include('listgroup.php');?>
                
              </div>
              <div class="col-md-7">
                <?php
                $type_id = $_GET['bt_id'];
                if($type_id ==''){
                include('ShowProduct.php');                  
                  }else{
                include('Producttype.php');
                }
                 
                ?>
              </div>
             <!--  <div class="col-md-3">
                <?php
                // include('cart.php');
                ?>
              </div> -->
            </div>
          </div>
          <!-- start footer-->
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <?php include('footer.php');?>
              </div>
            </div>
          </div>
          <!-- end footer-->

             <script>
        var slideIndex = 0;
        showSlides();

        function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
               slides[i].style.display = "none";  
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}    
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";  
            dots[slideIndex-1].className += " active";
            setTimeout(showSlides, 2000); // Change image every 2 seconds
        }
      </script>
        </body>
      </html>