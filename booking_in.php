<?php require_once('Connections/book.php'); ?>
<?php include('ckm.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<style type="text/css">
body {
	background-image: url(img/huayi.jpg_640x640.jpg);
}
</style>
</head>
<body>
	 <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-12">
           <?php include('css.php');?>
           <?php include('datatable.php'); ?>
         
        </div>
      </div>
    </div>

<div class="container">    
	<div class="row">


    <div class="col-md-12">
<h1 align="center">Book Ddelivery</h1>
</div>

      <div class="col-md-3">
        <?php include('m_menu.php');?>
      </div> 
      
      <?php 
		@$act=$_GET['act'];
		if($act=='ns'){
			 echo "<div class='col-md-7'>"; 
   			  echo "<br />";
			 		include('booking_add_ninght.php');
			 echo "</div>";	
		}else{
			 echo "<div class='col-md-9'>"; 
   			  echo "<br />";
		 			include('booking_list_in.php');
			echo "</div>";
		}
	
		 ?> 
	 </div>
</div>

</body>

</html>

<?php include('footer.php');?>