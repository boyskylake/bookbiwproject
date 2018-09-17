  <?php require_once('../Connections/book.php'); ?>
  <?php
error_reporting( error_reporting() & ~E_NOTICE );
if (!isset($_SESSION)) {
  session_start();
}
?>
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

$colname_member = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_member = $_SESSION['MM_Username'];
}
mysql_select_db($database_book);
$query_member = sprintf("SELECT * FROM tbl_member WHERE mem_user = %s", GetSQLValueString($colname_member, "text"));
$member = mysql_query($query_member) or die(mysql_error());
$row_member = mysql_fetch_assoc($member);
$totalRows_member = mysql_num_rows($member); 
?>
  <br />


  <div class="list-group">
    <a href="index.php" class="list-group-item list-group-item-warning">
    คุณ: <?php echo $row_member['mem_name']; ?>
    </a>
    <a href="index.php" class="list-group-item list-group-item-success">
    ข้อมูลในระบบ 
    </a>
    <a href="board.php" class="list-group-item">-ข้อมูลกระทู้</a>
    <a href="ss_booking.php" class="list-group-item">-รายการที่อนุมัติ</a>
    <a href="ds_booking.php" class="list-group-item">-รายการที่ไม่อนุมัติ</a>
    <a href="in_booking.php" class="list-group-item">-รายการที่คืนแล้ว</a>
    <a href="send_booking.php" class="list-group-item">-รายการที่ส่งแล้ว</a>
    <a href="revice_booking.php" class="list-group-item">-รายการที่รับแล้ว</a>
         <a href="../logout.php" class="list-group-item list-group-item-danger">-ออกจากระบบ</a>
</div>


<!--   <div class="list-group">
    <a href="index.php" class="list-group-item active">
    จัดการข้อมูลทั่วไป 
    </a>
    <a href="member.php" class="list-group-item">-จัดการสมาชิก</a>
    <a href="admin.php" class="list-group-item">-จัดการผู้ดูแลระบบ</a>
    <a href="type.php" class="list-group-item">-จัดการประเภทสินค้า</a>
    <a href="product.php" class="list-group-item">-จัดการสินค้า</a>
    <a href="wattudib.php" class="list-group-item">-จัดการวัตถุดิบ</a>
    

  </div> -->