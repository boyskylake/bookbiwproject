
<meta charset="utf-8">
<?php require_once('../Connections/book.php');
 // print_r($_POST);
 //  exit();
$mem_id = $_POST['mem_id'];
$ms_id = $_POST['ms_id'];
$mem_name = $_POST['mem_name'];
$mem_address = $_POST['mem_address'];
$mem_tel = $_POST['mem_tel'];
$mem_email = $_POST['mem_email'];
$mem_user = $_POST['mem_user'];
$mem_pass = $_POST['mem_pass'];

 $sql = "UPDATE tbl_member SET    
 			ms_id='$ms_id',
 			mem_name='$mem_name',
			mem_address='$mem_address',
			mem_tel='$mem_tel',
			mem_email='$mem_email',
			mem_user='$mem_user',
 			mem_pass='$mem_pass'
 			WHERE mem_id='$mem_id'
		 ";

		$result = mysql_db_query($database_book, $sql) or die ("Error in query: $sql". mysql_error());
	mysql_close();
 

	if($result){
   
			echo "<script type='text/javascript'>";
			echo  "alert('แก้ไขข้อมูลเรียบร้อยแล้ว!');";
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
  
