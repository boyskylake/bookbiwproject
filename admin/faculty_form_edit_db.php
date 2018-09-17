
<meta charset="utf-8">
<?php require_once('../Connections/book.php');
 // print_r($_POST);
 //  exit();
$ft_id = $_POST['ft_id'];
$ft_name = $_POST['ft_name'];

 $sql = "UPDATE tbl_faculty SET    
 			ft_name='$ft_name'
 			WHERE ft_id='$ft_id'
		 ";

		$result = mysql_db_query($database_book, $sql) or die ("Error in query: $sql". mysql_error());
	mysql_close();
 

	if($result){
   
			echo "<script type='text/javascript'>";
			echo  "alert('แก้ไขข้อมูลเรียบร้อยแล้ว!');";
			echo "window.location='faculty.php';";
			echo "</script>";
	  }
	  else{
		    echo "<script type='text/javascript'>";
				//echo  "alert('Error! กรุณาติดต่อเจ้าหน้าที่');";
				echo "window.location='faculty.php';";
			echo "</script>";
	  }
 


 ?>
  
