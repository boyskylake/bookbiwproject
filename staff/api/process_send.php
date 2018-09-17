<?php 
	require_once 'connect.php';
	@date_default_timezone_set("Asia/Bangkok");

	if (isset($_POST['data'])) {

		$now = DateTime::createFromFormat('U.u', microtime(true));
    	$date = $now->format('YmdHisu');

    	$id = $_POST['id'];

		$path = "../img/";
		$file = $date.".jpeg";
		$upload = $path.$file;

		$image = $_POST['data'];
		$rating = $_POST['rating'];


		if (file_put_contents($upload,base64_decode($image)) != false)

		{		
			mysql_select_db($database_book, $book);
			$sqlsend = "INSERT INTO `tbl_sendbook`(`sb_id`, `bi_id`, `img_send`, `score`, `date_send`) VALUES (NULL,'".$id."','".$file."','".$rating."','".$date."')";
			mysql_query($sqlsend, $book) or die(mysql_error());


			mysql_select_db($database_book, $book);
				$sql = "UPDATE `tbl_booking` SET `bi_status` = '6' WHERE `bi_id` = '".$id."'";
   			mysql_query($sql, $book) or die(mysql_error());

			echo "success";
			exit();
		}else{
			echo "failed";
			exit();
		}
	}
	else
	{
		echo "image_not_in";
		exit();
	}

 ?>