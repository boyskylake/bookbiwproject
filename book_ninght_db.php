<meta charset="utf-8">
<?php
require_once('Connections/book.php'); 

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

@$bi_id = $_POST['bi_id'];
@$bi_return = $_POST['bi_return'];
@$bi_in = $_POST['bi_in'];
@$bi_status = $_POST['bi_status'];
$bi_fine = $_POST['bi_fine'];
$bn_room = $_POST['bn_room'];
$bn_id = $_POST['bn_id'];
$bn_no = $_POST['bn_no'];
$bn_class = $_POST['bn_class'];
$s_at = $_POST['s_at'];


if($bi_fine <= 0){
           $sql = "UPDATE tbl_booking SET
 
			bi_in='$bi_in',
			bi_status='5',
			bi_fine='$bi_fine',
			bn_room='$bn_room',
			bn_id='$bn_id',
			bn_no='$bn_no',
			bn_class='$bn_class',
			s_at='$s_at'
			

			WHERE bi_id=$bi_id
";





		$result = mysql_db_query($database_book, $sql) or die ("Error in query: $sql " . mysql_error());

        }elseif($bi_fine > 0){
         $sql = "UPDATE tbl_booking SET
 
			bi_in='$bi_in',
			bi_status='4',
			bi_fine='$bi_fine',
			bn_room='$bn_room',
			bn_id='$bn_id',
			bn_no='$bn_no',
			bn_class='$bn_class',
			s_at='$s_at'
			

			WHERE bi_id=$bi_id
";




		$result = mysql_db_query($database_book, $sql) or die ("Error in query: $sql " . mysql_error());

        } 
        

        // exit();


foreach($_POST['mm'] as $row=>$art){
 
$QTY = mysql_real_escape_string($_POST['mm'][$row]);
$result = $QTY;  // value ที่ส่งมา
            $result_explode = explode('-', $QTY);   // ขั้นด้วย '-

            $ID = $result_explode[0];
            $QTY = $result_explode[1]; 
 
//  echo '<pre>';
//  echo  $ID.'-'.$QTY;
//  echo '</pre>';
// exit()
	$sql3	= "SELECT * FROM tbl_book where bo_id=$ID";
		$query3 = mysql_db_query($database_book, $sql3);
		$row3 = mysql_fetch_array($query3);
		@$total=$p_qty;
		$count=mysql_num_rows($query3);


  for($i=0; $i<$count; $i++){  
  $have =  $row3['bo_qty']; 
  $stc = $have + $QTY;  
  $sql5 = "UPDATE tbl_book SET  bo_qty=$stc WHERE  bo_id=$ID ";
  $query9 = mysql_db_query($database_book, $sql5);  
    
    }



}




 // $bi_return = date('Y-m-d',strtotime($bi_return));
 //        $bi_in = date('Y-m-d',strtotime($bi_in));
 //        $calculate =strtotime($bi_in)-strtotime($bi_return);
 //        @$bi_fine = $row_book['bi_fine'];
 //        $bi_fine = floor($calculate / 86400);



//  $sql = "UPDATE tbl_booking SET
 
// 			bi_in='$bi_in',
// 			bi_status='$bi_status',
// 			bi_fine='$bi_fine',
// 			bn_room='$bn_room',
// 			bn_id='$bn_id',
// 			bn_no='$bn_no',
// 			bn_class='$bn_class'
			

// 			WHERE bi_id=$bi_id
// ";

// exit();



		$result = mysql_db_query($database_book, $sql) or die ("Error in query: $sql " . mysql_error());

	mysql_close();
 

	if($result){
   
			echo "<script type='text/javascript'>";
			echo  "alert('ทำการคืนหนังสือเรียบร้อย!');";
			echo "window.location='booking_in.php';";
			echo "</script>";
	  }
	  else{
		    echo "<script type='text/javascript'>";
				//echo  "alert('Error! กรุณาติดต่อเจ้าหน้าที่');";
				echo "window.location='booking_in.php';";
			echo "</script>";
	  }
 


 ?>
 