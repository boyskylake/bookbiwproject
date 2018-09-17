
<meta charset="utf-8">
<?php require_once('../Connections/book.php');  

$bu_name = $_POST['bu_name'];


 $sql = "INSERT INTO  tbl_building
 			(
			bu_name
	
			)
				VALUES
			(
			'$bu_name'
			
			 )";

		$result = mysql_db_query($database_book, $sql) or die ("Error in query: $sql". mysql_error());
	mysql_close();
 

	if($result){
   
			echo "<script type='text/javascript'>";
			echo  "alert('เพิ่มข้อมูลเรียบร้อยแล้ว!');";
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
  
