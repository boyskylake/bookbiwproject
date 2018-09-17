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

// mysql_select_db($database_book, $book);
// $query_ss = "SELECT 
// * 
// FROM tbl_dating as d , tbl_member as m
// WHERE d.mem_id = m.mem_id
// AND m.ms_id = 2
// ORDER BY d.dt_id";
// $ss = mysql_query($query_ss, $book) or die(mysql_error());
// $row_ss = mysql_fetch_assoc($ss);
// $totalRows_ss = mysql_num_rows($ss);
// $dt_day=$row_ss['dt_day'];

$colname_member = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_member = $_SESSION['MM_Username'];
}
mysql_select_db($database_book);
$query_member = sprintf("SELECT 
* 
FROM tbl_member
WHERE mem_user = %s", GetSQLValueString($colname_member, "text"));
$member = mysql_query($query_member) or die(mysql_error());
$row_member = mysql_fetch_assoc($member);
$totalRows_member = mysql_num_rows($member);

mysql_select_db($database_book);
$query_dat = sprintf("SELECT 
* 
FROM tbl_dating as d , tbl_member as m
WHERE d.mem_id=m.mem_id
ORDER BY d.dt_id
", GetSQLValueString($colname_dat, "text"));
$dat = mysql_query($query_dat) or die(mysql_error());
$row_dat = mysql_fetch_assoc($dat);
$totalRows_dat = mysql_num_rows($dat);

$colname_show = "-1";
if (isset($_GET['bi_id'])) {
  $colname_show = $_GET['bi_id'];
}
mysql_select_db($database_book);
$query_show = sprintf("SELECT * FROM 
tbl_booking as o, 
tbl_booking_detail as d, 
tbl_book as p,
tbl_member  as m,
tbl_dating as t
WHERE o.bi_id = %s 
AND o.bi_id=d.bi_id 
AND d.bo_id=p.bo_id
AND t.mem_id = m.mem_id 
AND o.bi_id=t.bi_id
ORDER BY o.bi_id ASC
", GetSQLValueString($colname_show, "int"));
$show = mysql_query($query_show) or die(mysql_error());
$row_show = mysql_fetch_assoc($show);
$totalRows_show = mysql_num_rows($show);
$bo_id=$row_show['bo_id'];
$bo_qty=$row_show['bo_qty'];

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
   
 <?php 
      //$osum = 0;
      @$osum += $row_show['bd_qty'];
      @$dt_day = $row_show['dt_day'];
      @$dt_date = $row_show['dt_date'];
      @$mem_name = $row_show['mem_name'];

      ?>
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
    <div class="row">
   
      <div class="col-md-8" style="background-color:#f8f8f8">

            
            <h4> นัดหมายการส่งหนังสือ  </h4><br />
          
            จะจัดส่งวันที่:<?php echo date('d/m/Y',strtotime($dt_day));?><br />
            เวลา : <?php echo $dt_date; ?><br>
            พนักงาน:<?php echo $mem_name; ?>
                
        </div>
    </div>
  
      <?php 

mysql_free_result($member);
mysql_free_result($dat);
mysql_free_result($show);

?>
	