
<meta charset="utf-8">
<?php require_once('../Connections/book.php');  

$bt_name = $_POST['bt_name'];


 $sql = "INSERT INTO  tbl_book_type
 			(
			bt_name
	
			)
				VALUES
			(
			'$bt_name'
			
			 )";

		$result = mysql_db_query($database_book, $sql) or die ("Error in query: $sql". mysql_error());
	mysql_close();
 

	if($result){
   
			echo "<script type='text/javascript'>";
			echo  "alert('เพิ่มข้อมูลเรียบร้อยแล้ว!');";
			echo "window.location='type.php';";
			echo "</script>";
	  }
	  else{
		    echo "<script type='text/javascript'>";
				//echo  "alert('Error! กรุณาติดต่อเจ้าหน้าที่');";
				echo "window.location='type.php';";
			echo "</script>";
	  }
 


 ?>
  
