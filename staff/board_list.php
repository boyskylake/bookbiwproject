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
$query_board = "SELECT * FROM 
tbl_board as b ,tbl_member as m
WHERE b.mem_id = m.mem_id
order by b.b_id desc";
$board = mysql_query($query_board, $book) or die(mysql_error());
$row_board = mysql_fetch_assoc($board);
$totalRows_board = mysql_num_rows($board);
?>
<script>		
$(document).ready(function() {
    $('#example').DataTable( {
      "aaSorting" :[[0,'desc']],
	  //"lengthMenu":[[20,50, 100, -1], [20,50, 100,"All"]]
	});
} );
 
	</script>
	<style type="text/css">
	body {
	background-image: url(../img/huayi.jpg_640x640.jpg);
}
    </style>
	

<h4> ข้อมูลกระทู้
</h4>
 
<table border="2" class="display table table-bordered" id="example" align="center" >
  <thead>
    <tr class="success">    
    <th width="5%"><center>No.</center></th>
    <th width="20%"><center>คำถาม</center></th>
    <th width="20%"><center>ผู้ถาม</center></th>
    <th width="10%"><center>คำตอบ</center></th>
    <th width="10%"><center>วัน/เดือน/ปี</center></th>
  </tr>
</thead>
  <?php do { ?>
  
    <tr>
      <td ><?php echo $row_board['b_id']; ?></td>
      <td ><?php echo $row_board['b_title']; ?></td>
      <td ><?php echo $row_board['mem_name']; ?></td>
      <td><a href="board.php?b_id=<?php echo $row_board['b_id']; ?>&act=form" class="btn btn-info btn-sm" target="_blank">ตอบกระทู้</a> </td>
      <td><?php echo date('d/m/Y',strtotime($row_board['datesave'])); ?></td>
    </tr>

    <?php } while ($row_board =  mysql_fetch_assoc($board)); ?>
  
    </table>
<?php

mysql_free_result($board);
?>
