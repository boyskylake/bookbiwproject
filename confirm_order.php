<?php include('ckm.php');?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('css.php');?>
    <style type="text/css">
		input[type=number]{
			width:40px;
			text-align:center;
			color:red;
			font-weight:600;
		}
	body,td,th {
	font-family: Lato, "Helvetica Neue", Helvetica, Arial, sans-serif;
}
body {
	background-image: url(img/155791c6f9ec63b.jpg);
}
    </style>
  </head>
  <body>
   <?php  include('menu.php');?>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          
          <?php //include("slides.php");?>
          
          </div> <!-- close col-->
          </div> <!-- close row-->
          </div>    <!-- close container-->
 <!--start show  product-->
 <div class="container">
 	<div class="row">
    	<!-- categories-->
  <div class="col-md-2">
        	<?php include('listgroup.php');?>
        </div>
        <!-- product-->
        <div class="col-md-10">
         	 <?php  include('order.php');?>
    </div>
  </div>
</div>
 <!--end show  product-->
 
 
 
 
 
  </body>
</html>
<?php include('footer.php');?>