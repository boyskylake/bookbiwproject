<?php require_once('Connections/book.php'); ?>
<?php
error_reporting( error_reporting() & ~E_NOTICE );
if (!isset($_SESSION)) {
  session_start();
}
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

$colname_mmm = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_mmm = $_SESSION['MM_Username'];
}
mysql_select_db($database_book, $book);
$query_mmm = sprintf("SELECT
 * FROM 
 tbl_member as m ,tbl_board as b 
  WHERE m.mem_user = %s
  AND b.a_ans !='' 
  AND b.mem_id = m.mem_id 
  order by b.b_id desc", GetSQLValueString($colname_mmm, "text"));
$mmm = mysql_query($query_mmm, $book) or die(mysql_error());
$row_mmm = mysql_fetch_assoc($mmm);
$totalRows_mmm = mysql_num_rows($mmm);


// mysql_select_db($database_book, $book);
// $query_rb = "SELECT
//  * FROM 
//  tbl_board as b , tbl_member as m
//   WHERE a_ans !='' 
//   AND b.mem_id = m.mem_id
//   AND m.mem_id = $mem_id   
//   AND m.ms_id = 3
//   order by b_id desc";
// $rb = mysql_query($query_rb, $book) or die(mysql_error());
// $row_rb = mysql_fetch_assoc($rb);
// $totalRows_rb = mysql_num_rows($rb);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ระบบจองหนังสือ</title>
    <?php include('css.php');?>
     <style type="text/css">
     body,td,th {
	font-family: Lato, "Helvetica Neue", Helvetica, Arial, sans-serif;
}
body {
	background-image: url(img/huayi.jpg_640x640.jpg);
}
     </style>
     <?php include('datatable.php');?>
    
    
    
  </head>
  <body>
    <?php  include('menu.php');?>
   
         <div class="container">
  <div class="row">
    <div class="col-md-1"></div>
      <div class="col-md-10">
         <div class="panel panel-warning">
            <div class="panel-heading">
            <h4> ถาม-ตอบ  ||
            <a href="board_form.php?act=form" class="btn btn-success btn-xs"> +คำถาม </a>
             </h4> 
             </div>
            </div>


                <table border="2"  id="example" class="display table table-bordered">
                 <thead>
                  <tr class="success">
                    <th width="5%"><center>No.</center></th>
                    <th width="50%"><center>คำถาม</center></th>
                    <th width="20%"><center>ผู้ถาม</center></th>
                    <th width="5%"><center>-</center></th>
                    <th width="10%"><center>ว/ด/ป</center></th>
                  </tr>
                </thead>
                  <?php do { ?>
                    <tr>
                      <td align="center"><?php echo $row_mmm['b_id']; ?></td>
                      <td><?php echo $row_mmm['b_title']; ?></td>
                      <td><?php echo $row_mmm['b_name']; ?></td>
                      <td> 
                        <a href="board_detail.php?b_id=<?php echo $row_mmm['b_id'];?>&board-detial" class="btn btn-info btn-xs">ดูคำตอบ</a> 
                      </td>
                      <td><?php echo date('d/m/Y',strtotime($row_mmm['datesave'])); ?></td>
                    </tr>
                    <?php } while ($row_mmm = mysql_fetch_assoc($mmm)); ?>
                </table>
                <div class="col-md-1"></div>
              </div>
            </div>
          </div>
  
          <!-- start footer-->
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <?php include('footer.php');?>
              </div>
            </div>
          </div>
          <!-- end footer-->
        </body>
      </html>

