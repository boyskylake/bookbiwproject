
<meta charset="utf-8">
<?php require_once('../Connections/book.php');
 // print_r($_POST);
 //  exit();
$ms_id = $_POST['ms_id'];
$ms_name = $_POST['ms_name'];

 $sql = "UPDATE tbl_member_status SET    
 			ms_name='$ms_name'
 			WHERE ms_id='$ms_id'
		 ";

		$result = mysql_db_query($database_book, $sql) or die ("Error in query: $sql". mysql_error());
	mysql_close();
 

	if($result){
   
			echo "<script type='text/javascript'>";
			echo  "alert('แก้ไขข้อมูลเรียบร้อยแล้ว!');";
			echo "window.location='member_status.php';";
			echo "</script>";
	  }
	  else{
		    echo "<script type='text/javascript'>";
				//echo  "alert('Error! กรุณาติดต่อเจ้าหน้าที่');";
				echo "window.location='member_status.php';";
			echo "</script>";
	  }
 


 ?>
  
