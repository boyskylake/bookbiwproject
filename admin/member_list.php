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

mysql_select_db($database_book);
$query_member = "SELECT * 
FROM tbl_member as m,
tbl_member_status as s
WHERE m.ms_id = s.ms_id
ORDER BY m.mem_id DESC";
$member = mysql_query($query_member) or die(mysql_error());
$row_member = mysql_fetch_assoc($member);
$totalRows_member = mysql_num_rows($member);
?>
<script>		
$(document).ready(function() {
    $('#example').DataTable( {
      "aaSorting" :[[0,'desc']],
	  //"lengthMenu":[[20,50, 100, -1], [20,50, 100,"All"]]
	});
} );
 
	</script>

<h4> ข้อมูลสมาชิก  
<a href="member.php?act=form" class="btn btn-primary btn-sm">+ เพิ่มสมาชิก</a>
</h4>
 
<table border="2" class="display table table-bordered" id="example" align="center" >
  <thead>
    <tr class="success">    
    <th width="5%"><center>No.</center></th>
    <th width="20%"><center>ข้อมูลส่วนตัวสมาชิก</center></th>
    <th width="20%"><center>ข้อมูลติดต่อ</center></th>
    <th width="15%"><center>รหัสการเข้าใช้งาน</center></th>
    <th width="15%"><center>ระดับของผู้ใช้</center></th>
    <th width="10%"><center>แก้ไข</center></th>
  </tr>
</thead>
  <?php do { ?>
  
    <tr>
      <td ><?php echo $row_member['mem_id']; ?></td>
      <td >ชื่อ:<?php echo $row_member['mem_name']; ?><br>
    ที่อยู่:<?php echo $row_member['mem_address']; ?></td>
      <td >Tel:<?php echo $row_member['mem_tel']; ?><br>
      Email:<?php echo $row_member['mem_email']; ?></td>
      <td>Username:<?php echo $row_member['mem_user']; ?><br>
      Password:<?php echo $row_member['mem_pass']; ?></td>
      <td><?php echo $row_member['ms_name']; ?></td>
      <td align="center"><a href="member.php?mem_id=<?php echo $row_member['mem_id']; ?>&act=edit"
      class="btn btn-warning btn-xs"> แก้ไข </a> 
      <a href="member_del_db.php?mem_id=<?php echo $row_member['mem_id']; ?>" 
      onclick="return confirm('ยันยันการลบ')" class="btn btn-danger btn-xs">ลบ</a>
      
      </td>
    </tr>

    <?php } while ($row_member =  mysql_fetch_assoc($member)); ?>
  
    </table>
<?php


mysql_free_result($member);
?>
