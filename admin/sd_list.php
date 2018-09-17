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
$query_sd = "SELECT 
* FROM 
tbl_schedule as s ,tbl_member as m
WHERE s.mem_id = m.mem_id
AND m.ms_id = 2
ORDER BY s.sd_id";
$sd = mysql_query($query_sd, $book) or die(mysql_error());
$row_sd = mysql_fetch_assoc($sd);
$totalRows_sd = mysql_num_rows($sd);
?>
<style>
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}
</style>

<h4> ข้อมูลตารางเวร
  <!-- <a href="sd.php?act=form" class="btn btn-primary btn-sm">+ เพิ่มตารางเวร</a> --><br><br>
<div class="col-md6"></div>
<div class="col-md-6" align="left">
 

</div>

</h4>

 
<table id="customers">
  <tr>
    <th width="20%">วัน</th>
    <th width="60%">พนักงานเวร</th>
    <th width="20">จัดการ</th>
  </tr>
  <?php do { ?>
  <tr>
    <td><?php echo $row_sd['sd_day']?></td>
    <td><?php echo $row_sd['mem_name']?></td>
    <td align="center"><a href="sd.php?sd_id=<?php echo $row_sd['sd_id']; ?>&act=edit"
      class="btn btn-warning btn-xs"> แก้ไข </a> 
    
      
      </td>
  </tr>

  <?php } while ($row_sd =  mysql_fetch_assoc($sd)); ?>
    </table>
   
      <br />
    <?php
mysql_free_result($sd);
?>
