<?php require_once('Connections/book.php'); ?>
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
$query_tp = "SELECT * FROM tbl_book_type";
$tp = mysql_query($query_tp) or die(mysql_error());
$row_tp = mysql_fetch_assoc($tp);
$totalRows_tp = mysql_num_rows($tp);
?>

<div class="list-group">
  <a href="#" class="list-group-item active ">
    หมวดหมู่หนังสือ  </a>
  <?php do { ?>
    <a href="index.php?bt_id=<?php echo $row_tp['bt_id']; ?>" class="list-group-item"><?php echo $row_tp['bt_name']; ?></a>
    <?php } while ($row_tp = mysql_fetch_assoc($tp)); ?>
</div>
<?php
mysql_free_result($tp);
?>
