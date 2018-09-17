
<?php require_once('../Connections/book.php'); ?>
<?php //include('chkm.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<style type="text/css">
body {
	background-image: url(../img/huayi.jpg_640x640.jpg);
}
</style>
</head>
<body>
	 <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <?php include('datatable.php'); ?>
          <?php include('h.php');?>
        </div>
      </div>
    </div>

<div class="container">    
	<div class="row">
      <div class="col-md-2">
        <?php include('menu_left.php');?>
      </div> 
      
      <?php 
		@$act=$_GET['act'];
		if($act=='ss'){
			 echo "<div class='col-md-9'>"; 
   			  echo "<br />";
			 		include('ss_booking_detail.php');
			 echo "</div>";
		}elseif($act=='ds'){
				echo "<div class='col-md-7'>"; 
   			  	echo "<br />";
			 		include('ds_booking.php');
			 	echo "</div>";
		}elseif($act=='de'){
        		echo "<div class='col-md-9'>";
          		echo "<br />";
          		include('detail_booking.php');
        		echo "</div>";
		}else{
			 echo "<div class='col-md-9'>"; 
   			  echo "<br />";
		 			include('rev_booking_list.php');
			echo "</div>";
		}
	
		 ?> 
	 </div>
</div>

</body>

</html>

<?php include('footer.php');?>