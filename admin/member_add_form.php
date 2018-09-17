<?php require_once('../Connections/book.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_book, $book);
$query_type = "SELECT * FROM tbl_member_status";
$type = mysql_query($query_type, $book) or die(mysql_error());
$row_type = mysql_fetch_assoc($type);
$totalRows_type = mysql_num_rows($type);

mysql_select_db($database_book, $book);
$query_member = "SELECT * 
FROM tbl_member as m,
tbl_member_status as s
WHERE m.ms_id = s.ms_id
ORDER BY m.mem_id DESC";
$member = mysql_query($query_member, $book) or die(mysql_error());
$row_member = mysql_fetch_assoc($member);
$totalRows_member = mysql_num_rows($member);

?>
<form action="member_form_add_db.php" method="POST" enctype="multipart/form-data"  name="add" class="form-horizontal" id="add">
  <h4>เพิ่มข้อมูลสมาชิก</h4>
  <div class="form-group">
  <div class="col-sm-2" align="right">ระดับผู้ใช้งาน</div>
    <div class="col-sm-5" align="left">
  <select name="ms_id" id="ms_id" required="required" class="form-control" >
    <option value="00">--เลือกระดับผู้ใช้งาน--</option>
    <?php
do {  
?>
    <option value="<?php echo $row_type['ms_id']?>"><?php echo $row_type['ms_name']?></option>
    <?php
} while ($row_type = mysql_fetch_assoc($type));
  $rows = mysql_num_rows($type);
  if($rows > 0) {
      mysql_data_seek($type, 0);
	  $row_type = mysql_fetch_assoc($type);
  }
?>
  </select>
    </div>
    </div>
  <div class="form-group">
  <div class="col-sm-2" align="right">ขื่อ</div>
    <div class="col-sm-5" align="left">
  <input type="text" name="mem_name" id="mem_name" class="form-control" required="required">
    </div>
    </div>
    <div class="form-group">
  <div class="col-sm-2" align="right">ที่อยู่</div>
       <div class="col-sm-5" align="left">
        <textarea name="mem_address" id="mem_address" class="form-control" required="required"></textarea>
         </div>
       </div>
       
<div class="form-group">
    <div class="col-sm-2" align="right"> เบอร์โทร </div>
    <div class="col-sm-5" align="left">
     <input type="text" name="mem_tel" id="mem_tel" class="form-control" required="required">
    </div>
    </div>

  <div class="form-group">
    <div class="col-sm-2" align="right"> E-mail </div>
    <div class="col-sm-5" align="left">
     <input type="email" name="mem_email" id="mem_email" class="form-control" required="required">
    </div>
    </div>

    <div class="form-group">
    <div class="col-sm-2" align="right"> Username </div>
    <div class="col-sm-5" align="left">
     <input type="text" name="mem_user" id="mem_user" class="form-control" required="required">
    </div>
    </div>
            <div class="form-group">
    <div class="col-sm-2" align="right"> Password </div>
    <div class="col-sm-5" align="left">
     <input type="text" name="mem_pass" id="mem_pass" class="form-control" required="required">
    </div>
    </div>

<div class="form-group">
    <div class="col-sm-2"> </div>
    <div class="col-sm-6">
      <button type="submit" class="btn btn-primary" id="btn"> เพิ่มข้อมูล </button>
    </div>
  </div>
</form>
<?php


mysql_free_result($type);

mysql_free_result($member);
?>
