<meta charset="utf-8">
<?php
require_once('../Connections/book.php'); 
/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/

@$bo_id = $_POST['bo_id'];
$bt_id = $_POST['bt_id'];
$bo_name = $_POST['bo_name'];
$bo_detail = $_POST['bo_detail'];
$bo_qty = $_POST['bo_qty'];
@$bo_view = $_POST['bo_view'];
$img = $_POST['img'];
@$bo_img = $_POST['bo_img'];
$isbn = $_POST['isbn'];


// upload img
$upload=$_FILES['bo_img']['name'];

if($upload != ''){ 
$date = date("Y-m-d");
@$time = date(His);
$path="../img/";

	$type = strrchr($_FILES['bo_img']['name'],".");
	$newname = 'img'.$date.$time.$type;

$path_copy=$path.$newname;
$path_link="../img/".$newname;

move_uploaded_file($_FILES['bo_img']['tmp_name'],$path_copy);  
		
	
	} else {
		$newname = $img;

	}


 $sql = "UPDATE tbl_book SET
 
			bt_id='$bt_id',
			bo_name='$bo_name', 
			bo_detail='$bo_detail', 
			bo_qty='$bo_qty', 
			bo_view='$bo_view',
			isbn='$isbn',
			bo_img='$newname'


			WHERE bo_id=$bo_id
";

		$result = mysql_db_query($database_book, $sql) or die ("Error in query: $sql " . mysql_error());

	mysql_close();
 

	if($result){
   
			echo "<script type='text/javascript'>";
			echo  "alert('แก้ไขข้อมูลเรียบร้อย!');";
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
 