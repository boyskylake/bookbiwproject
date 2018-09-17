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
$query_book = "SELECT * 
FROM tbl_book as b,
tbl_book_type as t
WHERE b.bt_id = t.bt_id
ORDER BY b.bo_id DESC";
$book = mysql_query($query_book, $book) or die(mysql_error());
$row_book = mysql_fetch_assoc($book);
$totalRows_book = mysql_num_rows($book);
?>
<script>		
$(document).ready(function() {
    $('#example').DataTable( {
      "aaSorting" :[[0,'desc']],
	  //"lengthMenu":[[20,50, 100, -1], [20,50, 100,"All"]]
	});
} );
 
	</script>

<h4> ข้อมูลหนังสือ
<a href="book.php?act=form" class="btn btn-primary btn-sm">+ เพิ่มหนังสือ</a>
</h4>
 
<table border="2" class="display table table-bordered" id="example" align="center" >
  <thead>
    <tr class="success">    
    <th width="5%"><center>No.</center></th>
    <th width="10%"><center>ข้อมูลหนัสือ</center></th>
    <th width="30%"><center>รายละเอียด</center></th>
    <th width="10%"><center>รูปภาพ</center></th>
    <th width="10%"><center>จำนวนเข้าชม</center></th>
    <th width="10%"><center>แก้ไข</center></th>
  </tr>
</thead>
  <?php do { ?>
  
    <tr>
      <td ><?php echo $row_book['bo_id']; ?></td>
      <td >ประเภท:<?php echo $row_book['bt_name']; ?><br>
        ชื่อ:<?php echo $row_book['bo_name']; ?><br>
    จำนวน:<?php echo $row_book['bo_qty']; ?>เล่ม<br>
    ISBN:<?php echo $row_book['isbn']; ?></td>
      <td ><?php echo $row_book['bo_detail']; ?></td>
      <td><img src="../img/<?php echo $row_book['bo_img']; ?>" width="100"></td>
      <td><?php echo $row_book['bo_view']; ?></td>
      <td align="center"><a href="book.php?bo_id=<?php echo $row_book['bo_id']; ?>&act=edit"
      class="btn btn-warning btn-xs"> แก้ไข </a> 
      <a href="book_del_db.php?bo_id=<?php echo $row_book['bo_id']; ?>" 
      onclick="return confirm('ยันยันการลบ')" class="btn btn-danger btn-xs">ลบ</a>
      
      </td>
    </tr>

    <?php } while ($row_book =  mysql_fetch_assoc($book)); ?>
  
    </table>

<?php
mysql_free_result($book);
?>
	