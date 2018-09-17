<?php require_once('Connections/book.php'); ?>
<?php
session_start();
// print_r($_SESSION); 
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
$query_member = sprintf("SELECT  tbl_booking.bi_id,tbl_booking.bi_room,tbl_booking.bi_class,tbl_booking.bi_no,tbl_booking.bi_in,tbl_booking.bi_return,tbl_booking.bi_out,tbl_booking.bi_status,tbl_booking.bi_fine,

tbl_member.mem_id,tbl_member.mem_name,
tbl_faculty.ft_id,tbl_faculty.ft_name,
tbl_building.bu_id,tbl_building.bu_name
FROM tbl_booking

LEFT JOIN tbl_member
ON tbl_booking.mem_id=tbl_member.mem_id
LEFT JOIN tbl_faculty
ON tbl_booking.ft_id=tbl_faculty.ft_id
LEFT JOIN tbl_building
ON tbl_booking.bu_id=tbl_building.bu_id
WHERE tbl_member.mem_user=%s
ORDER BY tbl_booking.bi_id", GetSQLValueString($colname_member, "text"));
$member = mysql_query($query_member) or die(mysql_error());
$row_member = mysql_fetch_assoc($member);
$totalRows_member = mysql_num_rows($member);

$m_id = $row_member['mem_id'];




?>


<h4> ข้อมูลการสั่งซื้อ ||
</h4>
 
<table border="2" class="display table table-bordered" id="example" align="center" >
  <thead>
    <tr class="success">    
    <th width="5%"><center>รหัสการจอง</center></th>
    <th width="10%"><center>ชื่อผู้จอง</center></th>
    <th width="15%"><center>ข้อมูลการจอง</center></th>
    <th width="5%"><center>สถานะการจอง</center></th>
  </tr>
</thead>
  <?php if($totalRows_member > 0){ do{?>
  
    <tr>
      <td><?php echo $row_member['bi_id']; ?>
      <a href="my_order.php?bi_id=<?php echo $row_member['bi_id']; ?>&act=page">
      <span class="glyphicon glyphicon-zoom-in"></span>
      </a>
      </td>
     <td ><?php echo $row_member['mem_name']; ?></td>
      <td >
        วันที่จอง:
        <?php echo date('d/m/Y',strtotime($row_member['bi_out'])); ?> <br>
        กำหนดคืน:<?php $ods = $row_member['bi_return'];
        if($ods=='0000-00-00 00:00:00'){
          echo '-';
        }else{

          echo date('d/m/Y',strtotime($row_member['bi_return']));

        } ?><br>
        วันที่คืน:<?php $ods = $row_member['bi_in'];
        if($ods=='0000-00-00 00:00:00'){
          echo '-';
        }else{

          echo date('d/m/Y',strtotime($row_member['bi_in']));

        } ?><br>
        ค่าปรับ:<?php $odt = $row_member['bi_fine'];
        if($odt=='0.00'){
          echo '-';
        }else{
          echo "<font color='red'>";
          echo $row_member['bi_fine'];
          echo "</font>";
        } ?><br>
        จัดส่งที่:<?php 
        $bi_room=$row_member['bi_room'];
         if($bi_room ==1){
        echo "มารับที่ห้องสมุดสำนักวิทยบริการและเทคโนโลยีสารสนเทศ";
        }elseif($bi_room ==2){
        echo "ส่งที่";
        echo "อาคาร";
        echo $row_member['bu_name'];
        echo "ชั้น";
        echo $row_member['bi_class'];
        echo "ห้อง";
        echo $row_member['bi_no'];
        }elseif($bi_room ==3){
        echo "ห้องสมุดคณะ";
        echo $row_member['ft_name'];
        }?> 
      </td>
      
        <td><?php  
       @$bi_status=$row_member['bi_status'];
       if($bi_status =='1'){
        echo "<font color='#f25c10'>";
        echo "รออนุมัติ";
        echo "</font>";
        }elseif($bi_status =='2'){
        echo "<font color='green'>";
        echo "อนุมัติ";
        echo "</font>";
        }elseif($bi_status =='3'){
        echo "<font color='red'>";
        echo "ไม่อนุมัติ";
        echo "</font>";
         }elseif($bi_status =='4'){
        echo "<font color='blue'>";
        echo "คืนแล้ว";
        echo "</font>";
        echo "<font color='red'>";
        echo "(ค้างจ่าย)";
        echo "</font>";
           }elseif($bi_status =='5'){
        echo "<font color='blue'>";
        echo "คืนแล้ว";
        echo "</font>";
        }?></td>

    </tr>

<?php } while ($row_member =  mysql_fetch_assoc($member));} ?>
  
    </table>

<?php

mysql_free_result($member);
?>