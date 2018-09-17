<?php require_once('Connections/book.php'); ?>
<?php include('ckm.php');?>
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

$colname_book = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_book = $_SESSION['MM_Username'];
}
mysql_select_db($database_book, $book);
$query_book = sprintf("SELECT  tbl_booking.bi_id,tbl_booking.bi_room,tbl_booking.bi_class,tbl_booking.bi_no,tbl_booking.bi_in,tbl_booking.bi_return,tbl_booking.bi_out,tbl_booking.bi_status,tbl_booking.bi_fine,
tbl_member.mem_id,tbl_member.mem_name,tbl_member.mem_user,
tbl_faculty.ft_id,tbl_faculty.ft_name,
tbl_building.bu_id,tbl_building.bu_name
FROM tbl_booking
LEFT JOIN tbl_member
ON tbl_booking.mem_id=tbl_member.mem_id
LEFT JOIN tbl_faculty
ON tbl_booking.ft_id=tbl_faculty.ft_id
LEFT JOIN tbl_building
ON tbl_booking.bu_id=tbl_building.bu_id
WHERE  tbl_member.mem_user=%s
AND tbl_booking.bi_status = 2
ORDER BY tbl_booking.bi_id", GetSQLValueString($colname_book, "text"));
$book = mysql_query($query_book, $book) or die(mysql_error());
$row_book = mysql_fetch_assoc($book);
$totalRows_book = mysql_num_rows($book);
?>



<h4 align="center"> รายการจอง

</h4>
 
<table border="2" class="display table table-bordered" id="example" align="center" >
  <thead>
    <tr class="success">    
    <th width="5%"><center>รหัสการจอง</center></th>
    <th width="10%"><center>ชื่อผู้จอง</center></th>
    <th width="15%"><center>ข้อมูลการจอง</center></th>
    <th width="5%"><center>สถานะการจอง</center></th>
    <th width="5%"><center>จัดการ</center></th>
  </tr>
</thead>
  <?php if($totalRows_book > 0){ do{?>
  
    <tr>
      <td ><?php echo $row_book['bi_id']; ?>
      <a href="my_order.php?bi_id=<?php echo $row_book['bi_id']; ?>&act=page">
      <span class="glyphicon glyphicon-zoom-in"></span></a></td>
       <td ><?php echo $row_book['mem_name']; ?></td>
      <td >
        วันที่จอง:
        <?php echo date('d/m/Y',strtotime($row_book['bi_out'])); ?> <br>
        กำหนดคืน:<?php $ods = $row_book['bi_return'];
        if($ods=='0000-00-00 00:00:00'){
          echo '-';
        }else{

          echo date('d/m/Y',strtotime($row_book['bi_return']));

        } ?><br>
        วันที่คืน:<?php $ods = $row_book['bi_in'];
        if($ods=='0000-00-00 00:00:00'){
          echo '-';
        }else{

          echo date('d/m/Y',strtotime($row_book['bi_in']));

        } ?><br>
        ค่าปรับ:<?php $odt = $row_book['bi_fine'];
        if($odt=='0.00'){
          echo '-';
        }else{
          echo "<font color='red'>";
          echo $row_book['bi_fine'];

        } ?><br>
        จัดส่งที่:<?php 
        $bi_room=$row_book['bi_room'];
         if($bi_room ==1){
        echo "มารับที่ห้องสมุด";
        }elseif($bi_room ==2){
        echo "ส่งที่";
        echo "อาคาร";
        echo $row_book['bu_name'];
        echo "ชั้น";
        echo $row_book['bi_class'];
        echo "ห้อง";
        echo $row_book['bi_no'];
        }elseif($bi_room ==3){
        echo "ห้องสมุดคณะ";
        echo $row_book['ft_name'];
        }?> 
      </td>
      
        <td><?php  
       @$bi_status=$row_book['bi_status'];
       if($bi_status ==1){
        echo "<font color='blue'>";
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
        }?></td>
   <td align="center">
       <a href='booking_in.php?bi_id=<?php echo $row_book['bi_id']; ?>&act=ns'
      class='btn btn-info btn-xs'> ทำการคืน </a>   
  </td>
    </tr>

    <?php } while ($row_book =  mysql_fetch_assoc($book));} ?>
  
    </table>
  


<?php
mysql_free_result($book);
?>
	