
<meta charset="utf-8">
<?php require_once('../Connections/book.php');  

$mem_id = $_POST['mem_id'];
$sd_day = $_POST['sd_day'];


 $sql = "INSERT INTO  tbl_schedule
 			(
			mem_id, 
			sd_day
			
	
			)
				VALUES
			(
			'$mem_id',
			 '$sd_day'
			
			 )";

		$result = mysql_db_query($database_book, $sql) or die ("Error in query: $sql". mysql_error());
	mysql_close();
 

	if($result){
   
			echo "<script type='text/javascript'>";
			echo  "alert('เพิ่มข้อมูลเรียบร้อยแล้ว!');";
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
  
