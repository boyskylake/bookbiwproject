<meta charset="utf-8">
<?php
require_once('../Connections/book.php'); 

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";


foreach($_POST['mm'] as $row=>$art){
 
$QTY = mysql_real_escape_string($_POST['mm'][$row]);
$result = $QTY;  // value ที่ส่งมา
            $result_explode = explode('-', $QTY);   // ขั้นด้วย '-

            $ID = $result_explode[0];
            $QTY = $result_explode[1]; 
 
 // echo '<pre>';
 // echo  $ID.'-'.$QTY;
 // echo '</pre>';

	$sql3	= "SELECT * FROM tbl_book where bo_id=$ID";
		$query3 = mysql_db_query($database_book, $sql3);
		$row3 = mysql_fetch_array($query3);
		$total=$p_qty;
		$count=mysql_num_rows($query3);


  for($i=0; $i<$count; $i++){  
  $have =  $row3['bo_qty']; 
  $stc = $have + $QTY;  
  $sql5 = "UPDATE tbl_book SET  bo_qty=$stc WHERE  bo_id=$ID ";
  $query9 = mysql_db_query($database_book, $sql5);  
    
    }



}






@$bi_id = $_POST['bi_id'];
$bi_status = 3;
$bi_text = $_POST['bi_text'];


 $sql = "UPDATE tbl_booking SET
 
			bi_status='$bi_status',
			bi_text='$bi_text'

			WHERE bi_id=$bi_id
";

		$result = mysql_db_query($database_book, $sql) or die ("Error in query: $sql " . mysql_error());

	mysql_close();
 

	if($result){
   
			echo "<script type='text/javascript'>";
			echo  "alert('แจ้งข้อความเรียบร้อย!');";
			echo "window.location='booking.php';";
			echo "</script>";
	  }
	  else{
		    echo "<script type='text/javascript'>";
				//echo  "alert('Error! กรุณาติดต่อเจ้าหน้าที่');";
				echo "window.location='booking.php';";
			echo "</script>";
	  }
 


 ?>
 