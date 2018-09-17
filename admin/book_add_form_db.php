<meta charset="UTF-8" />
<?php 
require_once('../Connections/book.php');

    //Set ว/ด/ป เวลา ให้เป็นของประเทศไทย
    date_default_timezone_set('Asia/Bangkok');
	//สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลด
	$date1 = date("Ymd_His");
	//สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
	$numrand = (mt_rand());
	
	//รับชื่อไฟล์จากฟอร์ม 
	$bt_id= $_POST['bt_id'];
	$bo_name = $_POST['bo_name'];
	$bo_detail = $_POST['bo_detail'];
	$bo_qty = $_POST['bo_qty'];

	$bo_view = 0;
	$bo_img = (isset($_POST['bo_img']) ? $_POST['bo_img'] : '');
		
	$upload=$_FILES['bo_img'];
	if($upload <> '') { 

	//โฟลเดอร์ที่เก็บไฟล์
	$path="../img/";
	//ตัวขื่อกับนามสกุลภาพออกจากกัน
	$type = strrchr($_FILES['bo_img']['name'],".");
	//ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
	$newname =$numrand.$date1.$type;

	$path_copy=$path.$newname;
	$path_link="../img/".$newname;
	//คัดลอกไฟล์ไปยังโฟลเดอร์
	@move_uploaded_file($_FILES['bo_img']['tmp_name'],$path_copy);  
		
	
	}


			 $sql = "INSERT INTO tbl_book 
					(bt_id,
					bo_name, 
					bo_detail, 
					bo_qty,
					bo_view,
					bo_img) 
					VALUES
					('$bt_id',
					'$bo_name',
					'$bo_detail',
					'$bo_qty',
					'$bo_view',
					'$newname')";
		
		$result = mysql_db_query($database_book, $sql) or die ("Error in query: $sql " . mysql_error());

	mysql_close();



	if($result){
   
			echo "<script type='text/javascript'>";
			echo  "alert('เพิ่มข้อมูลเรียบร้อย');";
			echo "window.location='book.php';";
			echo "</script>";
	  }
	  else{
		    echo "<script type='text/javascript'>";
			echo  "alert('Error');";
				echo "window.location='book.php';";
			echo "</script>";
	  }
	
	
 ?>
