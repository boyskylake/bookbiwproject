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
$query_ds = "SELECT * FROM tbl_booking";
$ds = mysql_query($query_ds, $book) or die(mysql_error());
$row_ds = mysql_fetch_assoc($ds);
$totalRows_ds = mysql_num_rows($ds);


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

$bi_status=$row_show['bi_status'];

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
 <form action="ds_booking_db.php" method="POST" enctype="multipart/form-data"  name="addprd" class="form-horizontal" id="addprd">
<table border="2" class="display1 table table-bordered" id="example1" align="center" >
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
   <input  type="hidden" name="bo_id[]" value="<?php echo $row_show['bo_id']; ?>">
          <input  type="hidden" name="bd_qty[]" value="<?php  echo  $row_show['bd_qty']; ?>">

          <input  type="hidden" name="mm[]" value="<?php  echo  $row_show['bo_id']; ?>-<?php  echo  $row_show['bd_qty']; ?>">  
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
    if($bi_status == 3){ }else{?> 
    <h4 align="left"><b>ให้เหตุผลที่ไม่อนุมัติ</b></h4>
      <hr />
     
       <div class="form-group">

          <div class="col-sm-5">
            <p> ระบุเหตุผล </p>
            <textarea name="bi_text" id="bi_text" class="form-control"></textarea>
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

mysql_free_result($member);

mysql_free_result($show);



mysql_free_result($ds);
?>
	