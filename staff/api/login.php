<?php 
require_once('connect.php');

	$username = $_POST['username'];
	$password = $_POST['password'];

	mysql_select_db($database_book, $book);

	$sql = "SELECT * FROM tbl_member WHERE mem_user = '".$username."' and mem_pass = '".$password."'";

	$query = mysql_query($sql, $book) or die(mysql_error());
		

	$response=array();
	$response["sucess"]=false;

	if(!mysql_num_rows($query) > 0)
	{
			$status = "error";
			// echo json_encode($status);
			echo $status;
	}
	else
	{		$response["sucess"] = true;
		while ($fatch = mysql_fetch_assoc($query)) {
			
			$response["ID"] = $fatch['mem_id'];
			$response["NAME"] = $fatch['mem_name'];
		}
			// $status = "success";
			// echo json_encode($status);
			echo json_encode($response);
	}

 ?>