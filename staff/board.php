
<?php require_once('../Connections/book.php'); ?>
<?php //include('chkm.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

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
		if($act=='form'){
			 echo "<div class='col-md-9'>"; 
   			  echo "<br />";
			 		include('board_add_detail.php');
			 echo "</div>";
		}elseif($act=='edit'){
				echo "<div class='col-md-7'>"; 
   			  	echo "<br />";
			 		include('#');
			 	echo "</div>";
		
		}else{
			 echo "<div class='col-md-9'>"; 
   			  echo "<br />";
		 			include('board_list.php');
			echo "</div>";
		}
	
		 ?> 
	 </div>
</div>

</body>

</html>

<?php include('footer.php');?>