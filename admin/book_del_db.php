<?php
error_reporting( error_reporting() & ~E_NOTICE );
 require_once('../Connections/book.php'); 
 
$bo_id = $_GET['bo_id'];

$sql = "DELETE  FROM tbl_book WHERE  bo_id='$bo_id' ";
		$result = mysql_db_query($database_book, $sql) or die ("Error in query: $sql". mysql_error());	
	mysql_close();
 
	if($result){
   
			echo "<script type='text/javascript'>";
			//echo  "alert('เพิ่มข้อมูลเรียบร้อยแล้วครับ!');";
			echo "window.location='book.php';";
			echo "</script>";
	  }
	  else{
		    echo "<script type='text/javascript'>";
				//echo  "alert('Error! กรุณาติดต่อเจ้าหน้าที่');";
				echo "window.location='book.php';";
			echo "</script>";
	  }

 ?>
  





 
