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
$query_order = "SELECT b.bi_id,b.bi_in ,b.bi_out,b.bi_return,SUM(d.bd_qty) as qty,m.mem_name,b.bi_fine
FROM tbl_booking as b , tbl_booking_detail as d , tbl_book as o , tbl_member as m
WHERE b.bi_id = d.bi_id
AND d.bo_id = o.bo_id
AND b.mem_id = m.mem_id
AND b.bi_status = 4
GROUP BY DATE_FORMAT(b.bi_in, '%d%')
ORDER BY b.bi_id desc";
$order = mysql_query($query_order) or die(mysql_error());
$row_order = mysql_fetch_assoc($order);
$totalRows_order = mysql_num_rows($order);

?>
<script>
$(document).ready(function() {
$('#example').DataTable( {
"aaSorting" :[[0,'desc']],
//"lengthMenu":[[20,50, 100, -1], [20,50, 100,"All"]]
});
} );

</script>
<?php include('menu_report_top.php');?>
<h4> ข้อมูลการคืนหนังสือ(ค้างจ่าย)
</h4>
<div class="col-sm-8">
<table border="2" class="display table table-bordered table-striped" id="example" align="center" >
  <thead>
    <tr bgcolor="#ff0000">
      <th width="20%"><font color="#fff7f7"><center>รหัสการจอง</center></font></th>
      <th width="50%"><font color="#fff7f7"><center>ข้อมูลการจอง</center></font></th>
      <th width="20%"><font color="#fff7f7"><center>ค่าปรับ</center></font></th>
    </tr>
  </thead>
  <?php if($totalRows_order > 0){ do{?>
  <tr>
     <?php
  

   ?>
  
    <td><?php echo $row_order['bi_id'];?><a href="booking.php?bi_id=<?php echo $row_order['bi_id']; ?>&act=de">
      <span class="glyphicon glyphicon-zoom-in"></span></td>
    <td >ชื่อผู้จอง:<?php echo $row_order['mem_name'];?><br>
    กำหนดคืน:<?php echo date('d/m/Y',strtotime($row_order['bi_return'])); ?><br>
    วันที่คืน:<?php echo date('d/m/Y',strtotime($row_order['bi_in'])); ?><br>
    รวมจำนวนหนังสือ:<?php echo $row_order['qty'];?></td>
      <td><?php echo $row_order['bi_fine'];?></td>
  </tr>
  <?php
  @$total = $row_order['totol'];
  @$total2  += $total;
  ?>
  <?php } while ($row_order =  mysql_fetch_assoc($order));} ?>

</table>
</div> 
<?php
mysql_free_result($order);
?>