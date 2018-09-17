<?php

require_once('connect.php');

	$con = $_POST['con'];

if (isset($con)) {
// 
mysql_select_db($database_book, $book);
	$now = DateTime::createFromFormat('U.u', microtime(true));
    $date = $now->format('Ymd');

	$sql = "SELECT  tbl_booking.bi_id,tbl_booking.bi_room,tbl_booking.bi_class,tbl_booking.bi_no,tbl_booking.bi_in,tbl_booking.bi_return,tbl_booking.bi_out,tbl_booking.bi_status,tbl_booking.bi_fine,tbl_booking.bn_room,tbl_booking.bn_id,tbl_booking.bn_no,tbl_booking.bn_class,
		tbl_member.mem_id,tbl_member.mem_name,
		tbl_faculty.ft_id,tbl_faculty.ft_name,
		tbl_building.bu_id,tbl_building.bu_name
		FROM tbl_booking

		LEFT JOIN tbl_member
		ON tbl_booking.mem_id=tbl_member.mem_id
		LEFT JOIN tbl_faculty
		ON tbl_booking.ft_id=tbl_faculty.ft_id
		LEFT JOIN tbl_building
		ON tbl_booking.bu_id=tbl_building.bu_id
		WHERE tbl_booking.bi_status = 5 AND tbl_booking.bi_return = '$date'
		ORDER BY tbl_booking.bi_id";

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
    {	
        $response["sucess"] = true;

        while ($fatch = mysql_fetch_assoc($query)) {

        $detail = "สถานที่คืน: ";
        $bn_room=$fatch['bn_room'];
         if($bn_room ==1){
       $detail .= "ห้องสมุดสำนักวิทยบริการและเทคโนโลยีสารสนเทศ";
        }elseif($bn_room ==2){
        $detail .= "ให้พนักงานมารับที่";
        $detail .= "อาคาร";
        $detail .= $fatch['bu_name'];
        $detail .= "ชั้น";
        $detail .= $fatch['bn_class'];
        $detail .= "ห้อง";
        $detail .= $fatch['bn_no'];

	       $detail .= "วันที่จอง: ";
	       $detail .=  date('d/m/Y',strtotime($fatch['bi_out']));
	       $detail .= "  ";
	       $detail .= "  ";
	       // $detail .= "<br>";
	       $detail .= "กำหนดคืน: ";
	       $ods = $fatch['bi_return'];
	        if($ods=='0000-00-00'){
	          $detail .= ' - '."  ";
	        }else{

	          $detail .= date('d/m/Y',strtotime($fatch['bi_return']));
	          $detail .= "  ";
	        }
	       
	    }

        $response["content"][] = array('id' => $fatch['bi_id'],'name' => $fatch['mem_name'], 'detail' => $detail); 
        
        }
			
	echo json_encode($response);
	}
}
// 

?>