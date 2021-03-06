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

$colname_book = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_book = $_SESSION['MM_Username'];
}
mysql_select_db($database_book, $book);
$query_book = sprintf("SELECT  tbl_booking.bi_id,tbl_booking.bi_room,tbl_booking.bi_class,tbl_booking.bi_no,tbl_booking.bi_in,tbl_booking.bi_return,tbl_booking.bi_out,tbl_booking.bi_status,tbl_booking.bi_fine,tbl_booking.bn_room,tbl_booking.bn_id,tbl_booking.bn_no,tbl_booking.bn_class,tbl_booking.s_at,
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
AND tbl_booking.bi_status = 4
ORDER BY tbl_booking.bi_id", GetSQLValueString($colname_book, "text"));
$book = mysql_query($query_book, $book) or die(mysql_error());
$row_book = mysql_fetch_assoc($book);
$totalRows_book = mysql_num_rows($book);
?>


<h4 align="center"> แจ้งเตือนข้อมูลการจอง

</h4>
 
<table border="2" class="display table table-bordered" id="example" align="center" >
  <thead>
    <tr class="success">    
    <th width="5%"><center>รหัสการจอง</center></th>
    <th width="10%"><center>ชื่อผู้จอง</center></th>
    <th width="10%"><center>ข้อมูลการจอง</center></th>
    <th width="5%"><center>สถานะการจอง</center></th>
    <th width="10%"><center>ทำการคืน</center></th>
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
        วันที่คืน:<?php $odi = $row_book['bi_in'];
        if($odi=='0000-00-00 00:00:00'){
          echo '-';
        }else{

          echo date('d/m/Y',strtotime($row_book['bi_in']));

        } ?><br>
        <?php 
        $ods = date('Y-m-d',strtotime($ods));
        $odi = date('Y-m-d',strtotime($odi));
        $calculate =strtotime($odi)-strtotime($ods);
        $bi_fine = $row_book['bi_fine'];
        $bi_fine = floor($calculate / 86400);
        ?>
        ค่าปรับ:  <font color="red"><?php echo $row_book['bi_fine']; ?></font><br>
        จัดส่งที่:<?php 
        $bi_room=$row_book['bi_room'];
         if($bi_room ==1){
        echo "มารับที่ห้องสมุดสำนักวิทยบริการและเทคโนโลยีสารสนเทศ";
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
        echo "<font color='yellow'>";
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
        }?></td>
   <td>
   สถานที่คืน:<?php 
        $bn_room=$row_book['bn_room'];
         if($bn_room ==1){
        echo "ห้องสมุดสำนักวิทยบริการและเทคโนโลยีสารสนเทศ";
        }elseif($bn_room ==2){
        echo "ให้พนักงานมารับที่";
        echo "อาคาร";
        echo $row_book['bu_name'];
        echo "ชั้น";
        echo $row_book['bn_class'];
        echo "ห้อง";
        echo $row_book['bn_no'];
        }?> <br>
    จ่ายค่าปรับที่:<?php echo $row_book['s_at']; ?>
  </td>
    </tr>

    <?php } while ($row_book =  mysql_fetch_assoc($book));} ?>
  
    </table>

    

<?php
mysql_free_result($book);
?>
	