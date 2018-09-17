
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
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

$user_id = $_POST['id'];
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
  

	if($result){
		require_once('class.phpmailer.php');
		mysql_select_db($database_book, $book);
			$sql3 = "SELECT * FROM `tbl_member` WHERE `mem_id` = '".$user_id."' ";
			$book1 = mysql_query($sql3, $book) or die(mysql_error());
			$row = mysql_fetch_assoc($book1);


			mysql_select_db($database_book, $book);
			$sql4 = "SELECT * FROM `tbl_member` WHERE `mem_id` = '".$mem_id."' ";
			$book4 = mysql_query($sql4, $book) or die(mysql_error());
            $row4 = mysql_fetch_assoc($book4);
            
            mysql_select_db($database_book, $book);
			$sql5 = "SELECT * FROM 
				tbl_booking as o, 
				tbl_booking_detail as d, 
				tbl_book as p,
				tbl_member  as m
				WHERE o.bi_id = '".$bi_id."' 
				AND o.bi_id=d.bi_id 
				AND d.bo_id=p.bo_id
				AND o.mem_id = m.mem_id 
				ORDER BY o.bi_id ASC";
			$book5 = mysql_query($sql5, $book) or die(mysql_error());
			// $row_show = mysql_fetch_assoc($book5);
			$totalRows_show = mysql_num_rows($book5);


            echo $send = $row4['mem_email'];
            echo $recive = $row['mem_email'];
            $str = ('ยืนยันการจองหนังสือ');

            $mail = new PHPMailer();
            $mail->CharSet = "utf-8";
			$mail->IsHTML(true);
			$mail->IsSMTP();
			$mail->SMTPAuth = true; // enable SMTP authentication
			$mail->SMTPSecure = "tls"; // sets the prefix to the servier
			$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
			$mail->Port = 587; // set the SMTP port for the GMAIL server
			$mail->Username = "bnit2354@gmail.com"; // GMAIL username
            $mail->Password = "0801718551"; // GMAIL password
            $mail->From = $send;
			$mail->FromName = $send;  // set from Name
			$mail->Subject = $str; 
			$mail->Body = "อนุมัติการจอง เวลาที่ส่ง $dt_day <br>
            กำหนดคืน: $bi_return <br>
            วันที่คืน: $dt_date <br>";

            $mail->Body .= '<table border="2" class="display1 table table-bordered" id="example1" align="center" >
						  <thead>
						    <tr class="success">    
						   <th width="5%"><center>ID</center></th>
						      <th width="50%"><center>หนังสือ</center></th>
						      <th width="10%"><center>จำนวน</center></th></tr>
						</thead>';
						
			if($totalRows_show > 0)
			{
				while($row_show =  mysql_fetch_assoc($book5)){

				$mail->Body .= "<tr>
				     <td >".$row_show['bo_id']."</td>
				    <td >".$row_show['bo_name']."</td>
				    <td >".$row_show['bd_qty']."</td>";

				    @$osum += $row_show['bd_qty'];
				    $mail->Body .= "</tr>";
				}
			}

			$mail->Body .= '<tr>
				    <td colspan="4">
				      <p align="right">
				        <b>
				        <font color="red"> รวม = '.$osum.' เล่ม </font>
				        </b>
				      </p>
				    </td>
				  </tr>
				    </table>';

			
            $mail->Body .= "จัดส่งที่:มารับที่ห้องสมุดสำนักวิทยบริการและเทคโนโลยีสารสนเทศ";

			$mail->AddAddress($recive, $row['mem_name']); // to Address
			$mail->Send(); 
		   
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
  
