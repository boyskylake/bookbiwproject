<meta charset="UTF-8" />
<?php
include('../Connections/book.php');
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting( error_reporting() & ~E_NOTICE );

 date_default_timezone_set('Asia/Bangkok');

// print_r($_POST);
// exit;



  $a_ans = $_POST['a_ans'];
  $a_ans_date = date('Y-m-d');
  $b_id = $_POST['b_id'];
  

  $sql ="UPDATE tbl_board SET 
		
		a_ans='$a_ans', 
		a_ans_date='$a_ans_date'
		WHERE b_id=$b_id
		";
		
		$result = mysql_db_query($database_book, $sql) or die("Error in query : $sql" .mysql_error());

		mysql_close();
		
		if($result){
			echo "<script>";
			echo "alert('ตอบคำถามเรียบร้อยแล้ว');";
			echo "window.location ='board.php'; ";
			echo "</script>";
		} else {
			
			echo "<script>";
			echo "alert('ERROR!');";
			echo "window.location ='board.php'; ";
			echo "</script>";
		}
		


?>