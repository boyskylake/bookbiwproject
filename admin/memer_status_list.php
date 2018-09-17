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
$query_type = "SELECT * FROM tbl_member_status";
$type = mysql_query($query_type) or die(mysql_error());
$row_type = mysql_fetch_assoc($type);
$totalRows_type = mysql_num_rows($type);
?>



<script>		
$(document).ready(function() {
    $('#example').DataTable( {
      "aaSorting" :[[0,'desc']],
	  //"lengthMenu":[[20,50, 100, -1], [20,50, 100,"All"]]
	});
} );
 
	</script>

<h4> ข้อมูลระดับผู้ใช้งาน  
</h4>
 
<table border="2" class="display table table-bordered" id="example" align="center" >
  <thead>
    <tr class="success">    
    <th width="5%"><center>No.</center></th>
    <th width="30%"><center>ระดับผู้ใช้งาน</center></th>
    <th width="10%"><center>จัดการ</center></th>
  </tr>
</thead>
  <?php do { ?>
  
    <tr>
      <td ><?php echo $row_type['ms_id']; ?></td>
      <td ><?php echo $row_type['ms_name']; ?></td>
      <td align="center"><a href="member_status.php?ms_id=<?php echo $row_type['ms_id']; ?>&act=edit"
      class="btn btn-warning btn-xs"> แก้ไข </a> 
      <a href="member_status_del_db.php?ms_id=<?php echo $row_type['ms_id']; ?>" 
      onclick="return confirm('ยันยันการลบ')" class="btn btn-danger btn-xs">ลบ</a>
      
      </td>
    </tr>

    <?php } while ($row_type =  mysql_fetch_assoc($type)); ?>
  
    </table>
    <h4>:: เพิ่มระดับผู้ใช้งาน:: </h4>
      <form id="formadd" name="formadd" method="POST" action="member_status_form_add_db.php">
        <label for="ms_name"></label>
        <input name="ms_name" type="text" required="required" id="ms_name" size="20" class="form-control" />
        <input type="submit" name="button" id="button" value="เพิ่มข้อมูล" class="btn btn-primary" />
        <input type="hidden" name="MM_insert" value="formadd" />
      </form>
      <br />
<?php


mysql_free_result($type);
?>
