<?php

require_once('connect.php');

	$id = $_POST['id'];

if (isset($id)) {

		mysql_select_db($database_book, $book);

			$sql = "SELECT * FROM 
		tbl_booking as o, 
		tbl_booking_detail as d, 
		tbl_book as p,
		tbl_member  as m
		WHERE o.bi_id = '$id'
		AND o.bi_id=d.bi_id 
		AND d.bo_id=p.bo_id
		AND o.mem_id = m.mem_id 
		ORDER BY o.bi_id ASC";

    $query = mysql_query($sql, $book) or die(mysql_error());
    

	$response=array();
	$response["sucess"]=false;

	if(!mysql_num_rows($query) > 0)
	{
			$status = "error";
			echo $status;
	}
	else
    {	
        $response["sucess"] = true;
        while ($fatch = mysql_fetch_assoc($query)) {
        
        $response["content"][] = array('namebo' => $fatch['bo_name'],'img' => $fatch['bo_img']); 
        
        }
			echo json_encode($response);
	}
}
// 

?>