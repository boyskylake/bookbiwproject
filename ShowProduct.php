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

$bo_name = $_GET['bo_name'];
$type = $_GET['type_book'];

if (empty($type)) {
  $type = "bo_name";
}

mysql_select_db($database_book);
// $query_ShowProduct = "SELECT * FROM tbl_book WHERE `bo_name` LIKE  '%$bo_name%' ";
$query_ShowProduct = "SELECT * FROM tbl_book WHERE  ".$type." LIKE  '%$bo_name%' ";
$ShowProduct = mysql_query($query_ShowProduct) or die(mysql_error());
$row_ShowProduct = mysql_fetch_assoc($ShowProduct);
$totalRows_ShowProduct = mysql_num_rows($ShowProduct);
?>
<?php do { ?>
<?php
if($totalRows_ShowProduct >0){
?>
<div class="col-xs-6 col-sm-4 col-md-4 thumbnail">
  <!-- <div class="thumbnail"> -->
    <img src="img/<?php echo $row_ShowProduct['bo_img']; ?>" width="100%" style="padding-bottom:0px"/>
    <div class="caption">
      <center>
      <b><?php echo $row_ShowProduct['bo_name']; ?>
      <br />
      </b>
    </center>
      
      <p align="center">
        <a href="product_detail.php?bo_id=<?php echo $row_ShowProduct['bo_id'];?>&<?php echo $row_ShowProduct['bo_name']; ?>"
      class="btn btn-success btn-sm" role="button">รายละเอียด</a>
      
      <?php
      $qty = $row_ShowProduct['bo_qty'];
      if($qty == 0){
      echo "<font color='red'>";
      echo "<button class='btn btn-danger btn-sm' >จองแล้ว</button>";
      echo "</font>";
      }else{
      ?>
      
      
      <a href="cart.php?bo_id=<?php echo $row_ShowProduct['bo_id'];?>&act=add" class="btn btn-info btn-sm" role="button">จองหนังสือ</a>
      
      
      <?php  } ?>
    </p>
    
  <!-- </div> -->
</div>
</div>


<?php } else {
  
  echo "ไม่มีสินค้าที่ค้นหา";
  
  
  
};?>




<?php } while ($row_ShowProduct = mysql_fetch_assoc($ShowProduct)); ?>
<?php
mysql_free_result($ShowProduct);
?>