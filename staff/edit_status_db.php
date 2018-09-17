<meta charset="utf-8">
<?php
require_once('../Connections/book.php'); 



   

	@$bi_id = $_GET['bi_id'];
	$bi_status = 5;



 	$sql = "UPDATE tbl_booking SET

			bi_status='$bi_status'

			WHERE bi_id=$bi_id
";

		$result = mysql_db_query($database_book, $sql) or die ("Error in query: $sql " . mysql_error());
	mysql_close();


	if($result){
   
			echo "<script type='text/javascript'>";
			echo  "alert('ชำระค่าปรับเสร็จสิ้น');";
			echo "window.location='index.php?act=bf';";
			echo "</script>";
	  }
	  else{
		    echo "<script type='text/javascript'>";
				//echo  "alert('Error! กรุณาติดต่อเจ้าหน้าที่');";
				echo "window.location='index.php?act=bf';";
			echo "</script>";
	  }
 


 ?>
 