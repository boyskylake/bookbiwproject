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

$maxRows_rectype = 10;
$pageNum_rectype = 0;
if (isset($_GET['pageNum_rectype'])) {
  $pageNum_rectype = $_GET['pageNum_rectype'];
}
$startRow_rectype = $pageNum_rectype * $maxRows_rectype;

$colname_rectype = "-1";
if (isset($_GET['bt_id'])) {
  $colname_rectype = $_GET['bt_id'];
}
mysql_select_db($database_book, $book);
$query_rectype = sprintf("SELECT * FROM tbl_book WHERE bt_id = %s", GetSQLValueString($colname_rectype, "int"));
$query_limit_rectype = sprintf("%s LIMIT %d, %d", $query_rectype, $startRow_rectype, $maxRows_rectype);
$rectype = mysql_query($query_limit_rectype, $book) or die(mysql_error());
$row_rectype = mysql_fetch_assoc($rectype);

if (isset($_GET['totalRows_rectype'])) {
  $totalRows_rectype = $_GET['totalRows_rectype'];
} else {
  $all_rectype = mysql_query($query_rectype);
  $totalRows_rectype = mysql_num_rows($all_rectype);
}
$totalPages_rectype = ceil($totalRows_rectype/$maxRows_rectype)-1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>ระบบจองหนังสือ</title>
</head>

<body>
      <?php do { ?>
  <div class=" col-xs-6 col-sm-4 col-md-4">
    <div class="thumbnail">
       <img src="img/<?php echo $row_rectype['bo_img']; ?>" width="100%" style="padding-bottom:0px"/>
	<div class="caption">
    <center>
  		<b><?php echo $row_rectype['bo_name']; ?></b></center>
        <p align="center"><a href="product_detail.php?bo_id=<?php echo $row_rectype['bo_id'];?>&<?php echo $row_rectype['bo_name']; ?>" 
        class="btn btn-success btn-sm" role="button">รายละเอียด</a> 
       
       <?php
      $qty = $row_rectype['bo_qty'];
      if($qty == 0){
      echo "<font color='red'>";
      echo "<button class='btn btn-danger btn-sm' >หมด</button>";
      echo "</font>";
      }else{
      ?>

          <a href="cart.php?bo_id=<?php echo $row_rectype['bo_id'];?>&act=add" class="btn btn-info btn-sm" role="button">จอง</a>

           <?php  } ?>
</p>
       
    </div>
    </div>
  </div>
   <?php } while ($row_rectype = mysql_fetch_assoc($rectype)); ?>

</body>
</html>
<?php
mysql_free_result($rectype);
?>
