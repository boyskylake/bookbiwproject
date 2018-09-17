
<meta charset="utf-8">
<?php require_once('../Connections/book.php');
 // print_r($_POST);
 //  exit();
$bt_id = $_POST['bt_id'];
$bt_name = $_POST['bt_name'];

 $sql = "UPDATE tbl_book_type SET    
 			bt_name='$bt_name'
 			WHERE bt_id='$bt_id'
		 ";

		$result = mysql_db_query($database_book, $sql) or die ("Error in query: $sql". mysql_error());
	mysql_close();
 

	if($result){
   
			echo "<script type='text/javascript'>";
			echo  "alert('แก้ไขข้อมูลเรียบร้อยแล้ว!');";
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
  
