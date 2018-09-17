
<meta charset="utf-8">
<?php require_once('../Connections/book.php');  

$ms_id = $_POST['ms_id'];
$mem_name = $_POST['mem_name'];
$mem_address = $_POST['mem_address'];
$mem_tel = $_POST['mem_tel'];
$mem_email = $_POST['mem_email'];
$mem_user = $_POST['mem_user'];
$mem_pass = $_POST['mem_pass'];

 $sql = "INSERT INTO  tbl_member
 			(
			ms_id, 
			mem_name,
			mem_address,
			mem_tel,
			mem_email, 
			mem_user,
			mem_pass
			
	
			)
				VALUES
			(
			'$ms_id',
			 '$mem_name',
			 '$mem_address',
			 '$mem_tel',
			 '$mem_email',
			 '$mem_user',
			 '$mem_pass'
			
			 )";

		$result = mysql_db_query($database_book, $sql) or die ("Error in query: $sql". mysql_error());
	mysql_close();
 

	if($result){
   
			echo "<script type='text/javascript'>";
			echo  "alert('เพิ่มข้อมูลเรียบร้อยแล้ว!');";
			echo "window.location='member.php';";
			echo "</script>";
	  }
	  else{
		    echo "<script type='text/javascript'>";
				//echo  "alert('Error! กรุณาติดต่อเจ้าหน้าที่');";
				echo "window.location='member.php';";
			echo "</script>";
	  }
 


 ?>
  
