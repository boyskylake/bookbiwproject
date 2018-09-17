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
$query_member = "SELECT * 
FROM tbl_member as m,
tbl_member_status as s
WHERE m.ms_id = s.ms_id
AND m.ms_id = 2
ORDER BY m.mem_id DESC";
$member = mysql_query($query_member, $book) or die(mysql_error());
$row_member = mysql_fetch_assoc($member);
$totalRows_member = mysql_num_rows($member);
?>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>

<form action="sd_form_add_db.php" method="POST" enctype="multipart/form-data"  name="add" class="form-horizontal" id="add">
  <h4>เพิ่มข้อมูลตารางเวร</h4>
  <div class="form-group">
  <div class="col-sm-2" align="right">วัน</div>
    <div class="col-sm-5" align="left">
  	  <select name="sd_day" id="sd_day"  class="form-control">
  	    <option>--เลือกวัน--</option>
  	    <option>จันทร์</option>
  	    <option>อังคาร</option>
  	    <option>พุธ</option>
  	    <option>พฤหัสบดี</option>
  	    <option>ศุกร์</option>
      </select>
    </div>
    </div>
    <div class="form-group">
  <div class="col-sm-2" align="right">พนักงาน</div>
       <div class="col-sm-5" align="left">
      	 <select name="mem_id" id="mem_id" class="form-control">
      	   <option value="00">--เลือกพนักงาน--</option>
      	   <?php
do {  
?>
      	   <option value="<?php echo $row_member['mem_id']?>"><?php echo $row_member['mem_name']?></option>
      	   <?php
} while ($row_member = mysql_fetch_assoc($member));
  $rows = mysql_num_rows($member);
  if($rows > 0) {
      mysql_data_seek($member, 0);
	  $row_member = mysql_fetch_assoc($member);
  }
?>
         </select>
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




mysql_free_result($member);
?>
