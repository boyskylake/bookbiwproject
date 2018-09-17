<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	error_reporting( error_reporting() & ~E_NOTICE );
    session_start();  
	
  // echo "<pre>";
 	// print_r($_SESSION);
 	// echo "<hr>";
 	// print_r($_POST);
 	// echo "</pre>";
	
	// exit();

?>



<!--สร้างตัวแปรสำหรับบันทึกการสั่งซื้อ -->
<?php
   
require_once('Connections/book.php');


//Set ว/ด/ป เวลา ให้เป็นของประเทศไทย
date_default_timezone_set('Asia/Bangkok');
	$mem_id = $_POST['mem_id'];
	$bi_room = $_POST['bi_room'];
	$bu_id = $_POST['bu_id'];
	$ft_id = $_POST['ft_id'];
	$bi_class = $_POST['bi_class'];
	$bi_no = $_POST['bi_no'];
	$bi_in = '';
	$bi_return = '';
	$bi_out = date("Y-m-d H:i:s");
	$bi_status = 1;
	$bi_fine = $_POST['bi_fine'];
	$bi_text = $_POST['bi_text'];
	$bn_room = $_POST['bn_room'];
	$bn_id = $_POST['bn_id'];
	$bn_no = $_POST['bn_no'];
	$bn_class = $_POST['bn_class'];
	$s_at = $_POST['s_at'];



	
	//บันทึกการสั่งซื้อลงใน order_detail
	mysql_db_query($database_book, "BEGIN"); 
	$sql1 = "INSERT  INTO tbl_booking VALUES
	(NULL,
	'$mem_id',  
	'$bi_room',
	'$bu_id',
	'$ft_id',
	'$bi_class',
	'$bi_no',   
	'$bi_in',
	'$bi_return',  
	'$bi_out',
	'$bi_status',
	'$bi_fine',
	'$bi_text',
	'$bn_room',
	'$bn_id',
	'$bn_no',
	'$bn_class',
	'$s_at'
	)";
	
	$query1	= mysql_db_query($database_book, $sql1) or die ("Error in query: $sql1 " . mysql_error());

 
	$sql2 = "SELECT MAX(bi_id) AS bi_id FROM tbl_booking  WHERE mem_id='$mem_id'";
	$query2	= mysql_db_query($database_book, $sql2);
	$row = mysql_fetch_array($query2);
	$bi_id = $row['bi_id'];


	
	foreach($_SESSION['shopping_cart'] as $bo_id=>$bd_qty)
	 
	{
		$sql3	= "SELECT * FROM tbl_book where bo_id=$bo_id";
		$query3 = mysql_db_query($database_book, $sql3);
		$row3 = mysql_fetch_array($query3);
		// $total=$row3['pro_price']*$bd_qty;
		$count=mysql_num_rows($query3);

		
		$sql4	= "INSERT INTO  tbl_booking_detail 
		values(null,  
		'$bi_id',
		'$bo_id', 
		'$bd_qty'
	)";
		$query4	= mysql_db_query($database_book, $sql4);

			for($i=0; $i<$count; $i++){
			   
			  $have =  $row3['bo_qty']; //ใส่ที่เก็บจำนวนสินค้า
			  
			  $calstock = $have - $bd_qty;
			   


			  $sql9 = "UPDATE tbl_book SET  
			     bo_qty=$calstock
			     WHERE  bo_id=$bo_id";
			  $query9 = mysql_db_query($database_book, $sql9) or die ("Error in query: $sql9 " . mysql_error());  

			
			    }
 
	
	}
 
	
	if($query1 && $query4){
		mysql_db_query($database_book, "COMMIT");
		//$msg = "บันทึกข้อมูลเรียบร้อยแล้ว ";
		foreach($_SESSION['shopping_cart'] as $bo_id)
		{	
			unset($_SESSION['shopping_cart']);
			  //exit;
			echo "<script>";
			echo "alert('บันทึกข้อมูลเรียบร้อยแล้ว');";
			echo "window.location ='my_order.php?page=mycart'; ";
			echo "</script>";
		}
	}
	else{
		mysql_db_query($database_book, "ROLLBACK");  
			echo "<script>";
			echo "alert('บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่');";
			echo "window.location ='confirm_order.php'; ";
			echo "</script>";	
	}

	mysql_close();
?>
