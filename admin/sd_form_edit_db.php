
<meta charset="utf-8">
<?php require_once('../Connections/book.php');
 // print_r($_POST);
 //  exit();
$sd_id = $_POST['sd_id'];
$sd_day = $_POST['sd_day'];
$mem_id = $_POST['mem_id'];


 $sql = "UPDATE tbl_schedule SET    
 			sd_day='$sd_day',
 			mem_id='$mem_id'
 			WHERE sd_id='$sd_id'
		 ";

		$result = mysql_db_query($database_book, $sql) or die ("Error in query: $sql". mysql_error());
	mysql_close();
 

	if($result){
   
			echo "<script type='text/javascript'>";
			echo  "alert('แก้ไขข้อมูลเรียบร้อยแล้ว!');";
			echo "window.location='sd.php';";
			echo "</script>";
	  }
	  else{
		    echo "<script type='text/javascript'>";
				//echo  "alert('Error! กรุณาติดต่อเจ้าหน้าที่');";
				echo "window.location='sd.php';";
			echo "</script>";
	  }
 


 ?>
  
