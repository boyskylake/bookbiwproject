
<meta charset="utf-8">
<?php require_once('../Connections/book.php');  
error_reporting( error_reporting() & ~E_NOTICE );
    session_start(); 

 //  echo "<pre>";
 // 	// print_r($_SESSION);
 // 	echo "<hr>";
 // 	print_r($_POST);
 // 	echo "</pre>";
	
	// exit();
date_default_timezone_set('Asia/Bangkok');

$bi_id = $_POST['bi_id'];
$mem_id = $_POST['mem_id'];
$dt_day = $_POST['dt_day'];
$dt_date = $_POST['dt_date'];
$bo_id = $_POST['bo_id'];
$bo_qty = $_POST['bo_qty'];
$bd_qty = $_POST['bd_qty'];
$bi_status = 2;
$bi_return = $_POST['bi_return'];

 $sql = "INSERT INTO  tbl_dating
 			(
			bi_id,
			mem_id,
			dt_day,
			dt_date
	
			)
				VALUES
			(
			'$bi_id',
			'$mem_id',
			'$dt_day',
			'$dt_date'
			
			 )";

		$result = mysql_db_query($database_book, $sql) or die ("Error in query: $sql". mysql_error());


	$sql2 = "UPDATE tbl_booking SET  
     bi_status='$bi_status',
     bi_return='$bi_return'
     WHERE  bi_id=$bi_id";
  $query2 = mysql_db_query($database_book, $sql2) or die ("Error in query: $sql2 " . mysql_error());
  
  //   echo $sql2;
		// echo '</pre>';
		// exit();

	if($result){
		   
			echo "<script type='text/javascript'>";
			echo  "alert('เพิ่มข้อมูลเรียบร้อยแล้ว!');";
			echo "window.location='booking.php';";
			echo "</script>";
	  }
	  else{
		    echo "<script type='text/javascript'>";
				//echo  "alert('Error! กรุณาติดต่อเจ้าหน้าที่');";
				echo "window.location='booking.php';";
			echo "</script>";
	  }
 
	mysql_close();

 ?>
  
