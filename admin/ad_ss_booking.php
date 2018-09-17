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

mysql_select_db($database_book, $book);
$query_mm = "SELECT * 
FROM tbl_member
WHERE ms_id=2";
$mm = mysql_query($query_mm, $book) or die(mysql_error());
$row_mm = mysql_fetch_assoc($mm);
$totalRows_mm = mysql_num_rows($mm);

mysql_select_db($database_book, $book);
$query_ss = "SELECT 
* FROM tbl_dating ";
$ss = mysql_query($query_ss, $book) or die(mysql_error());
$row_ss = mysql_fetch_assoc($ss);
$totalRows_ss = mysql_num_rows($ss);
$dt_day=$row_ss['dt_day'];



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
$bo_id=$row_show['bo_id'];


?>
<script>		
$(document).ready(function() {
    $('#example').DataTable( {
      "aaSorting" :[[0,'desc']],
	  //"lengthMenu":[[20,50, 100, -1], [20,50, 100,"All"]]
	});
} );
 
	</script>

<h4> รายละเอียดการจอง
</h4>
 <form action="ss_booking_db.php" method="POST" enctype="multipart/form-data"  name="addprd" class="form-horizontal" id="addprd">
<table border="2" class="display table table-bordered" id="example" align="center" >
  <thead>
    <tr class="success">    
   <th width="5%"><center>ID</center></th>
      <th width="50%"><center>หนังสือ</center></th>
      <th width="10%"><center>จำนวน</center></th>
    
 
  </tr>
</thead>
  <?php if($totalRows_show > 0){ do{?>
  
    <tr>
     <td ><?php echo $row_show['bo_id']; ?></</td>
    <td ><?php echo $row_show['bo_name']; ?></td>
    <td ><?php echo $row_show['bd_qty']; ?></td>

            

 <?php 
      //$osum = 0;
      @$osum += $row_show['bd_qty'];?>
    </tr>

<?php } while ($row_show =  mysql_fetch_assoc($show));}?>

<tr>
    <td colspan="4">
      <p align="right">
        <b>
        <font color="red"> รวม = <?php echo $osum; ?>  เล่ม </font>
        </b>
      </p>
    </td>
  </tr>
  
    </table>
    <?php 
   if(@$bi_status == 2){ }else{?>
   
     
       
<h4 align="left"><b>กำหนดวันคืน</b></h4>
      <hr />
       <div class="form-group">

          <div class="col-sm-3">
            <p> ระบุวันคืน </p>
            <input type="date" name="bi_return" id="bi_return" class="form-control" />
          </div>
        </div>
 <h4 align="left"><b>ทำการนัดหมาย</b></h4>
      <hr />
       <div class="form-group">

          <div class="col-sm-3">
            <p> ระบุวันที่จะส่ง </p>
            <input type="date" name="dt_day" id="dt_day" class="form-control" />
          </div>
        </div>
         <div class="form-group">
          <div class="col-sm-3">
            <p> ระบุเวลาที่จะส่ง </p>
            <input type="time" name="dt_date" id="dt_date" class="form-control" />
          </div>
        </div>
            <div class="form-group">
          <div class="col-sm-3">
            <label for="mem_id"></label>
            <select name="mem_id" id="mem_id" class="form-control">
              <option value="00">--เลือกพนักงาน--</option>
              <?php
do {  
?>
              <option value="<?php echo $row_mm['mem_id']?>"><?php echo $row_mm['mem_name']?></option>
              <?php
} while ($row_mm = mysql_fetch_assoc($mm));
  $rows = mysql_num_rows($mm);
  if($rows > 0) {
      mysql_data_seek($mm, 0);
	  $row_mm = mysql_fetch_assoc($mm);
  }
?>
            </select>
          </div>
        </div>
         <div class="form-group">
          <div class="col-sm-12">
            <button type="submit" class="btn btn-success" name="btnadd"> ยืนยัน </button>
            <input type="hidden" name="bi_id" id="bi_id" value="<?php echo $_GET['bi_id']; ?>"
             />
               
          </div>
        </div>
      </form>
      <?php } ?>
      <?php 



mysql_free_result($show);

mysql_free_result($ss);

mysql_free_result($mm);
?>
	