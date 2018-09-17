<?php
error_reporting( error_reporting() & ~E_NOTICE );
 require_once('../Connections/book.php'); 
 
$bu_id = $_GET['bu_id'];

$sql = "DELETE  FROM tbl_building WHERE  bu_id='$bu_id' ";
		$result = mysql_db_query($database_book, $sql) or die ("Error in query: $sql". mysql_error());	
	mysql_close();
 
	if($result){
   
			echo "<script type='text/javascript'>";
			//echo  "alert('เพิ่มข้อมูลเรียบร้อยแล้วครับ!');";
			echo "window.location='building.php';";
			echo "</script>";
	  }
	  else{
		    echo "<script type='text/javascript'>";
				//echo  "alert('Error! กรุณาติดต่อเจ้าหน้าที่');";
				echo "window.location='building.php';";
			echo "</script>";
	  }

 ?>
  





 
