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

$colname_member = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_member = $_SESSION['MM_Username'];
}
mysql_select_db($database_book);
$query_member = sprintf("SELECT * FROM tbl_member WHERE mem_user = %s", GetSQLValueString($colname_member, "text"));
$member = mysql_query($query_member) or die(mysql_error());
$row_member = mysql_fetch_assoc($member);
$totalRows_member = mysql_num_rows($member);

$colname_show = "-1";
if (isset($_GET['bi_id'])) {
  $colname_show = $_GET['bi_id'];
}
mysql_select_db($database_book);
$query_show = sprintf("SELECT * FROM 
tbl_booking as o, 
tbl_booking_detail as d, 
tbl_book as p,
tbl_member  as m
WHERE o.bi_id = %s 
AND o.bi_id=d.bi_id 
AND d.bo_id=p.bo_id
AND o.mem_id = m.mem_id 
ORDER BY o.bi_id ASC
", GetSQLValueString($colname_show, "int"));
$show = mysql_query($query_show) or die(mysql_error());
$row_show = mysql_fetch_assoc($show);
$totalRows_show = mysql_num_rows($show);

// $query_discount = "SELECT 
// * FROM tb_order WHERE bi_id = $colname_show
// ";
// $discount = mysql_query($query_discount) or die(mysql_error());
// $row_discount = mysql_fetch_assoc($discount);
// $totalRows_discount = mysql_num_rows($discount);

// $numbercode=$row_show['numbercode'];
// $order_payment=$row_show['order_payment'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <?php include('datatable.php'); ?>
          <?php include('css.php');?>
  </head>
  <body>
<script>		
$(document).ready(function() {
    $('#example').DataTable( {
      "aaSorting" :[[0,'desc']],
	  //"lengthMenu":[[20,50, 100, -1], [20,50, 100,"All"]]
	});
} );
 
	</script>
  <p id="hip">
<button class="btn btn-success btn-sm" onClick="window.print()"> print </button></p>
<h3 align="center"> รหัสการจอง<font color="#f20707">0000<?php echo $row_show['bi_id']; ?></font>
</h3>
 <div class="container">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
<table border="2" class="display1 table table-bordered" id="example1" align="center" >
  <thead>
    <tr class="success">    
   <th width="5%"><center>ID</center></th>
      <th width="50%"><center>หนังสือ</center></th>
      <th width="10%"><center>จำนวน</center></th>

    
 
  </tr>
</thead>
  <?php if($totalRows_show > 0){ do{?>
  <?php 
      //$osum = 0;
      @$osum += $row_show['bd_qty'];

      $bi_return = $row_show['bi_return']; 
      $bi_in = $row_show['bi_in']; 

       // $bi_return = date('Y-m-d',strtotime($bi_return));
       //  $bi_in = date('Y-m-d',strtotime($bi_in));
       //  $calculate =strtotime($bi_in)-strtotime($bi_return);
        @$bi_fine = $row_show['bi_fine'];
       //  $bi_fine = floor($calculate / 86400);
      ?>
    <tr>
     <td ><?php echo $row_show['bo_id']; ?></td>
    <td ><?php echo $row_show['bo_name']; ?></td>
    <td ><?php echo $row_show['bd_qty']; ?></td>

   
 
    </tr>

<?php } while ($row_show =  mysql_fetch_assoc($show));}?>

<tr>
    <td colspan="3">
      <p align="right">
        <b>
         รวม =<font color="red"> <?php echo $osum; ?> </font> เล่ม <br>
         กำหนดคืน:<font color="red"> <?php echo date('d/m/Y',strtotime($bi_return));?></font><br>
            คืนวันที่:<font color="red"> <?php echo date('d/m/Y',strtotime($bi_in));?></font><br>
         ค่าปรับ =<font color="red"><?php echo $bi_fine ;?></font>บาท
        </b>
      </p>
    </td>
  </tr>
 <!--  <tr>
    <td colspan="4">
      <p align="right">
        <b>
         ค่าปรับ =<font color="red"><?php echo $bi_fine * 15;?></font>เล่ม 
        </b>
      </p>
    </td>
  </tr> -->
  
    </table>
  </div>
 <div class="col-md-3"></div>
 <div class="col-md-5" align="right"><br>
 (....................................................) <br>
 <div class="col-sm-11">
 (ผู้จ่ายเงิน)
</div>
</div>
<div class="col-md-4" align="right"><br>
 (....................................................) <br>

 <div class="col-sm-10">
(ผู้รับเงิน)
</div>
</div>
<div class="col-md-3"></div>

</div>
</div>


   
     
     <?php 

mysql_free_result($member);

mysql_free_result($show);
?>
	</body>
  </html>