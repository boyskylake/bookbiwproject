<?php

require_once('connect.php');

	$con = $_POST['con'];

if (isset($con)) {
// 
mysql_select_db($database_book, $book);
	$now = DateTime::createFromFormat('U.u', microtime(true));
    $date = $now->format('Ymd');

	$sql = "SELECT  tbl_booking.bi_id,tbl_booking.bi_room,tbl_booking.bi_class,tbl_booking.bi_no,tbl_booking.bi_in,tbl_booking.bi_return,tbl_booking.bi_out,tbl_booking.bi_status,tbl_booking.bi_fine,
		tbl_member.mem_id,tbl_member.mem_name,
		tbl_faculty.ft_id,tbl_faculty.ft_name,
		tbl_dating.dt_id,tbl_dating.dt_day,
		tbl_building.bu_id,tbl_building.bu_name
		FROM tbl_booking
		LEFT JOIN tbl_member
		ON tbl_booking.mem_id=tbl_member.mem_id
		LEFT JOIN tbl_faculty
		ON tbl_booking.ft_id=tbl_faculty.ft_id
		LEFT JOIN tbl_building
		ON tbl_booking.bu_id=tbl_building.bu_id
		LEFT JOIN tbl_dating
		ON tbl_booking.bi_id=tbl_dating.bi_id
		WHERE tbl_booking.bi_status = 2 AND tbl_dating.dt_day = '$date'
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

	       $detail = "วันที่จอง: ";
	       $detail .=  date('d/m/Y',strtotime($fatch['bi_out']));
	       $detail .= "  ";
	       $detail .= "  ";
	       // $detail .= "<br>";
	       $detail .= "กำหนดคืน: ";
	       $ods = $fatch['bi_return'];
	        if($ods=='0000-00-00 00:00:00'){
	          $detail .= ' - '."  ";
	        }else{

	          $detail .= date('d/m/Y',strtotime($fatch['bi_return']));
	          $detail .= "  ";
	        }
	        // $detail .= "<br>";
	        $detail .= "วันที่คืน: "."  ";
	        $odi = $fatch['bi_in'];
	        if($odi=='0000-00-00 00:00:00'){
	          $detail .=  ' -'."  ";
	        }else{

	          $detail .= date('d/m/Y',strtotime($fatch['bi_in']));
	          $detail .= "  ";
	        }
	        // $detail .= "<br>";
	         
	        $ods = date('Y-m-d',strtotime($ods));
	        $odi = date('Y-m-d',strtotime($odi));
	        $calculate =strtotime($odi)-strtotime($ods);
	        $bi_fine = $fatch['bi_fine'];
	        $bi_fine = floor($calculate / 86400);
	        //กำหนดคืน
	        
	       $detail .= "ค่าปรับ: ";
	        if( $bi_fine < 1){
	          $detail .= ' 0.00'."  ";
	          $detail .= "  ";
	        }else{
	          $detail .= $bi_fine * 15;
	          $detail .= "  ";

	        } 
	        // $detail .= "<br>";
	        $detail .= " จัดส่งที่: ";

	        $bi_room = $fatch['bi_room'];
	         if($bi_room ==1){
	        $detail .= "มารับที่ห้องสมุดสำนักวิทยบริการและเทคโนโลยีสารสนเทศ";
	        }elseif($bi_room ==2){
	        $detail .= "ส่งที่";
	        $detail .= "อาคาร";
	        $detail .= $fatch['bu_name'];
	        $detail .= "ชั้น";
	        $detail .= $fatch['bi_class'];
	        $detail .= "ห้อง";
	        $detail .= $fatch['bi_no'];
	        }elseif($bi_room ==3){
	        $detail .= "ห้องสมุดคณะ";
	        $detail .= $fatch['ft_name'];
	        }

        $response["content"][] = array('id' => $fatch['bi_id'],'name' => $fatch['mem_name'], 'detail' => $detail); 
        
        }
			
	echo json_encode($response);
	}
}
// 

?>