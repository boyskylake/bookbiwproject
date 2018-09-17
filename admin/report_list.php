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
$query_order = "SELECT b.bi_id,b.bi_out ,SUM(d.bd_qty) as qty,m.mem_name,b.bi_fine,b.bi_status
FROM tbl_booking as b , tbl_booking_detail as d , tbl_book as o , tbl_member as m
WHERE b.bi_id = d.bi_id
AND d.bo_id = o.bo_id
AND b.mem_id = m.mem_id
GROUP BY b.bi_id
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
<h4> ข้อมูลการจองหนังสือ
</h4>
<div class="col-sm-8">
<table border="2" class="display table table-bordered table-striped" id="example" align="center" >
  <thead>
    <tr bgcolor="#50e8a9">
      <th width="20%"><center>รหัสการจอง</center></th>
      <th width="50%"><center>ข้อมูลการจอง</center></th>
      <th width="30%"><center>สถานะ</center></th>
    </tr>
  </thead>
  <?php if($totalRows_order > 0){ do{?>
  <tr>
     <?php
   @$osum += $row_order['bd_qty'];?>
  
    <td><?php echo $row_order['bi_id'];?><a href="booking.php?bi_id=<?php echo $row_order['bi_id']; ?>&act=de">
      <span class="glyphicon glyphicon-zoom-in"></span></td>
    <td>ชื่อผู้จอง:<?php echo $row_order['mem_name'];?><br>
    วันที่จอง:<?php echo date('d/m/Y',strtotime($row_order['bi_out'])); ?><br>
    รวมจำนวนหนังสือ:<?php echo $row_order['qty'];?></td>
     <td><?php  
       @$bi_status=$row_order['bi_status'];
       if($bi_status ==1){
        echo "<font color='#f25c10'>";
        echo "รออนุมัติ";
        echo "</font>";
        }elseif($bi_status ==2){
        echo "<font color='green'>";
        echo "อนุมัติ";
        echo "</font>";
        }elseif($bi_status ==3){
        echo "<font color='red'>";
        echo "ไม่อนุมัติ";
        echo "</font>";
      }elseif($bi_status ==4){
        echo "<font color='blue'>";
        echo "คืนแล้ว";
        echo "</font>";
        echo "<font color='red'>";
        echo "(ค้างจ่าย)";
        echo "</font>";
      }elseif($bi_status ==5){
        echo "<font color='blue'>";
        echo "คืนแล้ว";
        echo "</font>";
        }?></td>
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