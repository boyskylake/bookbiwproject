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

$colname_type = "-1";
if (isset($_GET['ft_id'])) {
  $colname_type = $_GET['ft_id'];
}
mysql_select_db($database_book);
$query_type = sprintf("SELECT * FROM tbl_faculty WHERE ft_id = %s", GetSQLValueString($colname_type, "int"));
$type = mysql_query($query_type) or die(mysql_error());
$row_type = mysql_fetch_assoc($type);
$totalRows_type = mysql_num_rows($type);
?>



<form action="faculty_form_edit_db.php" method="POST" enctype="multipart/form-data"  name="add" class="form-horizontal" id="add">
  <h4>เแก้ไขคณะ</h4>
  <div class="form-group">
  <div class="col-sm-2" align="right">คณะ</div>
    <div class="col-sm-5" align="left">
  <input type="text" name="ft_name" id="ft_name" class="form-control" value="<?php echo $row_type['ft_name']; ?>">
    </div>
    </div>
    
           
<div class="form-group">
    <div class="col-sm-2"> </div>
    <div class="col-sm-6">
      <button type="submit" class="btn btn-primary" id="btn"> ยืนยัน </button>
      <input type="hidden" name="ft_id" value="<?php echo $row_type['ft_id']; ?>">
    </div>
  </div>
</form>
<?php




mysql_free_result($type);
?>
